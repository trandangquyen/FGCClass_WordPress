<?php
/**
 * Class object to load php view files
 * Creator by Mr. Quyen
 */

class ViewLoader
{
    //this variable to save loaded view files
    private $__content = array();
    // Load view
    //function to load view files, param is view file name and data that send via view;
    public function load($view, $data = array())
    {
        // function to covert a array to sigle variables
        extract($data);
        // change content view to a variable width ab_start();
        ob_start();
        require_once __DIR__ . '/../view/' . $view . '.php';
        $content = ob_get_contents();
        ob_end_clean();
        // Assign the content to the loaded view list
        $this->__content[] = $content;
        //The function displays the entire view loaded, which is used by the controller
        foreach ($this->__content as $html){
            echo $html;
        }

    }
}