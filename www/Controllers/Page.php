<?php 
namespace App;
use App\Core\Security as coreSecurity;
use App\Core\View;
use App\Models\Page as ModelsPage;
use App\Models\Categorie;
use App\Models\Page_categorie;
class Page{

    public function defaultAction(){
        $security = new coreSecurity(); 
		if(!$security->isConnected()){
			header('Location: /');
		}
        $pages = new ModelsPage;
        $view = new View('admin/liste-page','back');
        $view->assign('pages',$pages->getUris());
        $view->assign("title","Admin Liste Pages");

        
    }

    public function notifAction($erreur){
        $pages = new ModelsPage;
        $view = new View('admin/liste-page','back');
        $view->assign('pages',$pages->getUris());
        $view->assign("title","Admin Liste Pages");
        $view->assign("erreur",$erreur);
        
    }


    

    public function mainAction(){
        $uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
        $uri = $uriExploded[0];
        $uriex = explode("/",$uri);
        $pages = new ModelsPage;
        $page = $pages->getPageByUrl($uriex[1]);
        $articles = $pages->getArticleByIdPage($page["id"]);
        if ($page['status'] == 0 ){
            $view = new View("page", "front");
            $view->assign('page',$page);
            $view->assign('articles',$articles);
            $view->assign("title",$page['slug']);
        }
        else{
            $view = new View("error/404", "front");
            $view->assign("title","Erreur 404");
        }
        
    
    }


    public function addpageAction(){
        $security = new coreSecurity(); 
		if(!$security->isConnected()){
			header('Location: /');
		}
        $categorie = new Categorie;
        $view = new view('admin/add-page','back');
        $view->assign('categories',$categorie->getCategories());
        $view->assign('title','Add Page');
    }

    public function createAction(){
        
        if(isset($_POST)){
            $security = new coreSecurity(); 
            if(!$security->isConnected()){
                header('Location: /');
            }
            $pages = new ModelsPage;
            $verification = $pages->getallpage();
            foreach($verification as $page){
                if($page['url'] == $_POST['url'] ){
                    $this->notifAction("Url Existant");
                    exit;
                }
            }

            if (count($_POST) == 4 ||  5){
                $pages->setUrl(htmlspecialchars($_POST['url']));
                $pages->setSlug(htmlspecialchars($_POST['slug']));
                $pages->setContent(htmlspecialchars($_POST['content']));
                $pages->setisMenu(0);
                $pages->setisAccueil(0);
                $pages->save();
                $lastepage = $pages->getlastedpage();
                $pages->setId($lastepage[0]['id']);
                if(!empty($_POST['pagecat'])){
                    foreach($_POST['pagecat'] as $cat){
                        $page_cate = new Page_categorie;
                        $page_cate->setId_page($pages->getId());
                        $page_cate->setId_categorie($cat);
                        $page_cate->save();
                        // $pages->savepagecat($pages->getId(),$cat);
                    }
                }
                $this->notifAction("Votre Page a été créér");
            }
            else{
                $this->notifAction("Erreur Lors de la création (Tentative de Hack FAILLE XSS)");
            }
            // $pages->savePages(htmlspecialchars($_POST['url']),htmlspecialchars($_POST['slug']),htmlspecialchars($_POST['content']),$_POST['status']);
            
        }
        else{
            header('Location: /admin/tableau-de-bord');
        }


    }

    public function deleteAction(){

        if(isset($_GET['id'])){
            $id_page = $_GET['id'];
            $pages = new ModelsPage;
            $pages->pagedelete($id_page);
            $this->notifAction("La Page a été Supprimer");
            exit;
        }
        else{
            $this->notifAction("Erreur URL");
            exit;
        }
        
    }

    public function editpageAction(){
        $security = new coreSecurity(); 
		if(!$security->isConnected()){
			header('Location: /');
		}
        $id_page =$_GET['id']; 
        $pages = new ModelsPage;
        $page = $pages->getpage($id_page);
        $id_categories = $pages->getCategoriesById($id_page);
        $categories = $pages->getCategories();
        $view = new View('admin/edit-page','back');
        $view->assign("title","Editeur de page");
        $view->assign('page',$page);
        $view->assign('id_categories',$id_categories);
        $view->assign('categories',$categories);

    }

    public function editerAction(){
        if(!empty($_POST['id'])){
            $page = new ModelsPage;
            $page->setId($_POST['id']);
            if(!empty($_POST['url'])){
                $page->setUrl(htmlspecialchars($_POST['url']));

            }
            if(!empty($_POST['slug'])){
                $page->setSlug(htmlspecialchars($_POST['slug']));
            }
            $page->setContent($_POST['content']);
            $page->setStatus($_POST['status']);
            $same=array();
            $page->save();
            $id_categories = $page->getCategoriesById($_POST['id']);
            $page->delatepagecat($_POST['id']);
            if(!empty($_POST['pagecat'])){
                foreach($_POST['pagecat'] as $cat){
                    $page_cate = new Page_categorie;
                    $page_cate->setId_page($_POST['id']);
                    $page_cate->setId_categorie($cat);
                    $page_cate->save();
                    // $page->savepagecat($_POST['id'],$cat);

                }
            }
            $this->notifAction("Votre Page a été modifiée");
        }
        else{
            header('Location: /admin/tableau-de-bord');
        }
        
        // header('location: /admin/liste-Pages?message=2');
        // foreach($_POST['pagecat'] as $cat){
        //     foreach($id_categories as $id){
        //         if($cat == $id['id_categorie']){
        //             array_push($same,$cat);
        //         }
        //     }
        // }
        // var_dump($same);
        // var_dump($_POST['pagecat']);
        // foreach($_POST['pagecat'] as $cat){
        //     $delete =1;
        //     foreach ($same as $ifsame){
        //         if ($cat = $ifsame){
        //             $delete = 0;
        //         }
        //     }
        //     if($delete == 1){
        //         $page->savepagecat($_POST['id'],$cat);
        //     }

        // }

        // foreach($id_categories as $id_cat){
        //     $update=1;
        //     foreach($same as $ifsame){
        //         if ($id_cat['id_categorie'] == $ifsame){
        //             $update = 0;
        //         }
        //     }
        //     if($update == 1){
        //         $page->delatepagecat($_POST['id'],$id_cat['id_categorie']);
        //     }
        // }
        
        

    }



}
?>