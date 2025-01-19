<?php
    class ExptCustom extends Exception{
        private $erro = '';

        public function __construct($erro)
        {  
           $this->erro = $erro; 
        }

        public function getErr(){
            return $this->erro;
        }

    };

    try {
        throw new ExptCustom('Erro teste');
    }catch (ExptCustom $e){
        echo $e->getErr();
    }
?>