<?php

class AreaAtuacaoHabilidade extends TRecord
{
    const TABLENAME  = 'area_atuacao_habilidade';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    private $habilidade;
    private $area_atuacao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('area_atuacao_id');
        parent::addAttribute('habilidade_id');
            
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

