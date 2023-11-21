<?php

class PessoaVaga extends TRecord
{
    const TABLENAME  = 'pessoa_vaga';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $pessoa;
    private $vaga;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('pessoa_id');
        parent::addAttribute('vaga_id');
    
    }

    /**
     * Method set_pessoa
     * Sample of usage: $var->pessoa = $object;
     * @param $object Instance of Pessoa
     */
    public function set_pessoa(Pessoa $object)
    {
        $this->pessoa = $object;
        $this->pessoa_id = $object->id;
    }

    /**
     * Method get_pessoa
     * Sample of usage: $var->pessoa->attribute;
     * @returns Pessoa instance
     */
    public function get_pessoa()
    {
    
        // loads the associated object
        if (empty($this->pessoa))
            $this->pessoa = new Pessoa($this->pessoa_id);
    
        // returns the associated object
        return $this->pessoa;
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

    public static function getByPessoaVaga($pessoa, $vaga)
    {
        return self::where('pessoa_id','=',$pessoa)
                   ->where('vaga_id','=',$vaga)
                   ->load();
    }

}

