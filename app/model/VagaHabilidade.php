<?php

class VagaHabilidade extends TRecord
{
    const TABLENAME  = 'vaga_habilidade';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $vaga;
    private $habilidade;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('vaga_id');
        parent::addAttribute('habilidade_id');
            
    }

    /**
     * Method set_vaga
     * Sample of usage: $var->vaga = $object;
     * @param $object Instance of Vaga
     */
    public function set_vaga(Vaga $object)
    {
        $this->vaga = $object;
        $this->vaga_id = $object->id;
    }

    /**
     * Method get_vaga
     * Sample of usage: $var->vaga->attribute;
     * @returns Vaga instance
     */
    public function get_vaga()
    {
    
        // loads the associated object
        if (empty($this->vaga))
            $this->vaga = new Vaga($this->vaga_id);
    
        // returns the associated object
        return $this->vaga;
    }
    /**
     * Method set_habilidade
     * Sample of usage: $var->habilidade = $object;
     * @param $object Instance of Habilidade
     */
    public function set_habilidade(Habilidade $object)
    {
        $this->habilidade = $object;
        $this->habilidade_id = $object->id;
    }

    /**
     * Method get_habilidade
     * Sample of usage: $var->habilidade->attribute;
     * @returns Habilidade instance
     */
    public function get_habilidade()
    {
    
        // loads the associated object
        if (empty($this->habilidade))
            $this->habilidade = new Habilidade($this->habilidade_id);
    
        // returns the associated object
        return $this->habilidade;
    }

    
}

