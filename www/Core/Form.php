<?php

namespace App\Core;

class Form
{

	public static function validator($data, $config){
		$errors = [];
		//echo "<pre>";
		//print_r($data);
		//print_r($config);

		//Est-ce que j'ai le bon nb d'inputs ?

		if( count($data) == count($config["input"])){

			foreach ($config["input"] as $name => $configInput) {
				
				if( !empty($configInput["lengthMin"]) 
					&& is_numeric($configInput["lengthMin"]) 
					&& strlen($data[$name])<$configInput["lengthMin"] ){
					
					$errors[] = $configInput["error"];

				}

			}

		}else{
			$errors[] = "Tentative de Hack (Faille XSS)";
		}

		return $errors; //tableau des erreurs
	}





	public static function showForm($form)
    {
	
	if(empty($_GET)){
        $html = "<form ".(!empty($form["config"]["id"]) ? "id='".$form["config"]["id"]."'": "")." class='".($form["config"]["class"]??"")."' method='".( self::cleanWord($form["config"]["method"]) ?? "GET" )."' action='".( $form["config"]["action"] ?? "" )."'>";


        foreach ($form["input"] as $name => $dataInput) {

            $html .="</br><label for='".$name."'>".($dataInput["label"]??"")." </label>";


            if ($dataInput["type"]  ==="mytextarea" ){


                $html .= "</br><textarea	 
						id='".$name."'
			 			class='".($dataInput["class"]??"")."' 
						name='".$name."'
						type='".($dataInput["type"] ?? "mytextarea")."'
						placeholder='".($dataInput["placeholder"] ?? "")."'
						".((!empty($dataInput["required"]))?"required='required'":"")."
						>".((!empty($dataInput["defaultValue"]))?"" . $dataInput["defaultValue"] . "":"")."</textarea></br>";

            }else{
            $html .= "</br><input 
						id='".$name."'
			 			class='".($dataInput["class"]??"")."' 
						name='".$name."'
						type='".($dataInput["type"] ?? "text")."'
						placeholder='".($dataInput["placeholder"] ?? "")."'
						".((!empty($dataInput["required"]))?"required='required'":"")."
						".((!empty($dataInput["defaultValue"]))?"value='" . $dataInput["defaultValue"] . "'":"")."
						>";
						
            }

        }
	}else{
		//print_r($_GET);
		$html = "<form ".(!empty($form["config"]["id"]) ? "id='".$form["config"]["id"]."'": "")." class='".($form["config"]["class"]??"")."' method='".( self::cleanWord($form["config"]["method"]) ?? "GET" )."' action='".( $form["config"]["action"] ?? "" )."'>";


        foreach ($form["input"] as $name => $dataInput) {

            $html .="</br><label for='".$name."'>".($dataInput["label"]??"")." </label>";


            if ($dataInput["type"]  ==="mytextarea" ){


                $html .= "</br><textarea	 
						id='".$name."'
			 			class='".($dataInput["class"]??"")."' 
						name='".$name."'
						type='".($dataInput["type"] ?? "mytextarea")."'
						placeholder='".($dataInput["placeholder"] ?? "")."'
						".((!empty($dataInput["required"]))?"required='required'":"")."
						>".((!empty($dataInput["defaultValue"]))?"" . $dataInput["defaultValue"] . "":"")."</textarea></br>";

            }else{
            $html .= "</br><input 
						id='".$name."'
			 			class='".($dataInput["class"]??"")."' 
						name='".$name."'
						type='".($dataInput["type"] ?? "text")."'
						placeholder='".($dataInput["placeholder"] ?? "")."'
						".((!empty($dataInput["required"]))?"required='required'":"")."
						".((!empty($dataInput["defaultValue"]))?"value='" . $dataInput["defaultValue"] . "'":"")."
						>";
						
            }

        }

	}

        $html .= "</br><button type='submit' value='".( self::cleanWord($form["config"]["Submit"]) ?? "Valider" )."'>".( self::cleanWord($form["config"]["Submit"]) ?? "Valider" )."</button></form>";


        echo $html;
    }


	public static function cleanWord($word){
		return str_replace("'", "&apos;", $word);
	}

}