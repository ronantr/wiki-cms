<?php 
namespace App;
use App\Core\View;
use App\Models\Page as ModelsPage;
use App\Models\Categorie;
class Page{

    public function defaultAction(){
        $pages = new ModelsPage;
        $view = new View('admin/liste-page','back');
        $view->assign('pages',$pages->getUris());
        $view->assign("title","Liste Pages");

        
    }


    public function addpageAction(){
        $categorie = new Categorie;
        $view = new view('admin/add-page','back');
        $view->assign('categories',$categorie->getCategories());
        $view->assign('title','Add Page');
    }

    public function createAction(){
        if(isset($_POST)){
            
            $pages = new ModelsPage;
            $verification = $pages->getallpage();
            foreach($verification as $page){
                if($page['url'] == $_POST['url'] ){
                    header('Location: /admin/liste-Pages?message=4');
                    exit;
                }
            }
            $pages->savePages(htmlspecialchars($_POST['url']),htmlspecialchars($_POST['slug']));
            $lastepage = $pages->getlastedpage();
            $pages->setId($lastepage[0]['id']);
            if(!empty($_POST['pagecat'])){
                foreach($_POST['pagecat'] as $cat){
                    $pages->savepagecat($pages->getId(),$cat);
                }
            }
            header('Location: /admin/liste-Pages?message=1');
        }
        else{
            header('Location: /admin/tableau-de-bord');
        }


    }

    public function deleteAction(){
        $id_page = $_GET['id'];
        $pages = new ModelsPage;
        $pages->pagedelete($id_page);
        header('Location: /admin/liste-Pages?message=3');
    }

    public function editpageAction(){
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
        $page = new ModelsPage;
        $page->setId($_POST['id']);
        if(!empty($_POST['url'])){
            $page->setUrl(htmlspecialchars($_POST['url']));
        }
        if(!empty($_POST['slug'])){
            $page->setSlug(htmlspecialchars($_POST['slug']));
        }
        $page->setStatus($_POST['status']);
        $same=array();
        $page->save();
        $id_categories = $page->getCategoriesById($_POST['id']);
        $page->delatepagecat($_POST['id']);
        if(!empty($_POST['pagecat'])){
            foreach($_POST['pagecat'] as $cat){
                $page->savepagecat($_POST['id'],$cat);
            }
        }

        header('location: /admin/liste-Pages?message=2');
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