<?php

class CursoAreaAtuacao extends TRecord
{
    const TABLENAME  = 'curso_area_atuacao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    private $curso;
    private $area_atuacao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('curso_id');
        parent::addAttribute('area_atuacao_id');
            
    }

    /**
     * Method set_curso
     * Sample of usage: $var->curso = $object;
     * @param $object Instance of Curso
     */
    public function set_curso(Curso $object)
    {
        $this->curso = $object;
        $this->curso_id = $object->id;
    }

    /**
     * Method get_curso
     * Sample of usage: $var->curso->attribute;
     * @returns Curso instance
     */
    public function get_curso()
    {
    
        // loads the associated object
        if (empty($this->curso))
            $this->curso = new Curso($this->curso_id);
    
        // returns the associated object
        return $this->curso;
    }
    /**
     * Method set_area_atuacao
     * Sample of usage: $var->area_atuacao = $object;
     * @param $object Instance of AreaAtuacao
     */
    public function set_area_atuacao(AreaAtuacao $object)
    {
        $this->area_atuacao = $object;
        $this->area_atuacao_id = $object->id;
    }

    /**
     * Method get_area_atuacao
     * Sample of usage: $var->area_atuacao->attribute;
     * @returns AreaAtuacao instance
     */
    public function get_area_atuacao()
    {
    
        // loads the associated object
        if (empty($this->area_atuacao))
            $this->area_atuacao = new AreaAtuacao($this->area_atuacao_id);
    
        // returns the associated object
        return $this->area_atuacao;
    }

    
}

