<?php

class Vaga extends TRecord
{
    const TABLENAME  = 'vaga';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const CREATEDAT  = 'created_at';

    private $regime_trabalho;
    private $modelo_trabalho;
    private $curso;
    private $pessoa;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('email');
        parent::addAttribute('salario');
        parent::addAttribute('periodo_ini');
        parent::addAttribute('periodo_fim');
        parent::addAttribute('observacao');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('ativo');
        parent::addAttribute('pessoa_id');
        parent::addAttribute('regime_trabalho_id');
        parent::addAttribute('modelo_trabalho_id');
        parent::addAttribute('curso_id');
            
    }

    /**
     * Method set_regime_trabalho
     * Sample of usage: $var->regime_trabalho = $object;
     * @param $object Instance of RegimeTrabalho
     */
    public function set_regime_trabalho(RegimeTrabalho $object)
    {
        $this->regime_trabalho = $object;
        $this->regime_trabalho_id = $object->id;
    }

    /**
     * Method get_regime_trabalho
     * Sample of usage: $var->regime_trabalho->attribute;
     * @returns RegimeTrabalho instance
     */
    public function get_regime_trabalho()
    {
    
        // loads the associated object
        if (empty($this->regime_trabalho))
            $this->regime_trabalho = new RegimeTrabalho($this->regime_trabalho_id);
    
        // returns the associated object
        return $this->regime_trabalho;
    }
    /**
     * Method set_modelo_trabalho
     * Sample of usage: $var->modelo_trabalho = $object;
     * @param $object Instance of ModeloTrabalho
     */
    public function set_modelo_trabalho(ModeloTrabalho $object)
    {
        $this->modelo_trabalho = $object;
        $this->modelo_trabalho_id = $object->id;
    }

    /**
     * Method get_modelo_trabalho
     * Sample of usage: $var->modelo_trabalho->attribute;
     * @returns ModeloTrabalho instance
     */
    public function get_modelo_trabalho()
    {
    
        // loads the associated object
        if (empty($this->modelo_trabalho))
            $this->modelo_trabalho = new ModeloTrabalho($this->modelo_trabalho_id);
    
        // returns the associated object
        return $this->modelo_trabalho;
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
     * Method getVagaHabilidades
     */
    public function getVagaHabilidades()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('vaga_id', '=', $this->id));
        return VagaHabilidade::getObjects( $criteria );
    }
    /**
     * Method getPessoaVagas
     */
    public function getPessoaVagas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('vaga_id', '=', $this->id));
        return PessoaVaga::getObjects( $criteria );
    }

    public function set_vaga_habilidade_vaga_to_string($vaga_habilidade_vaga_to_string)
    {
        if(is_array($vaga_habilidade_vaga_to_string))
        {
            $values = Vaga::where('id', 'in', $vaga_habilidade_vaga_to_string)->getIndexedArray('id', 'id');
            $this->vaga_habilidade_vaga_to_string = implode(', ', $values);
        }
        else
        {
            $this->vaga_habilidade_vaga_to_string = $vaga_habilidade_vaga_to_string;
        }

        $this->vdata['vaga_habilidade_vaga_to_string'] = $this->vaga_habilidade_vaga_to_string;
    }

    public function get_vaga_habilidade_vaga_to_string()
    {
        if(!empty($this->vaga_habilidade_vaga_to_string))
        {
            return $this->vaga_habilidade_vaga_to_string;
        }
    
        $values = VagaHabilidade::where('vaga_id', '=', $this->id)->getIndexedArray('vaga_id','{vaga->id}');
        return implode(', ', $values);
    }

    public function set_vaga_habilidade_habilidade_to_string($vaga_habilidade_habilidade_to_string)
    {
        if(is_array($vaga_habilidade_habilidade_to_string))
        {
            $values = Habilidade::where('id', 'in', $vaga_habilidade_habilidade_to_string)->getIndexedArray('id', 'id');
            $this->vaga_habilidade_habilidade_to_string = implode(', ', $values);
        }
        else
        {
            $this->vaga_habilidade_habilidade_to_string = $vaga_habilidade_habilidade_to_string;
        }

        $this->vdata['vaga_habilidade_habilidade_to_string'] = $this->vaga_habilidade_habilidade_to_string;
    }

    public function get_vaga_habilidade_habilidade_to_string()
    {
        if(!empty($this->vaga_habilidade_habilidade_to_string))
        {
            return $this->vaga_habilidade_habilidade_to_string;
        }
    
        $values = VagaHabilidade::where('vaga_id', '=', $this->id)->getIndexedArray('habilidade_id','{habilidade->id}');
        return implode(', ', $values);
    }

    public function set_pessoa_vaga_pessoa_to_string($pessoa_vaga_pessoa_to_string)
    {
        if(is_array($pessoa_vaga_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $pessoa_vaga_pessoa_to_string)->getIndexedArray('id', 'id');
            $this->pessoa_vaga_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_vaga_pessoa_to_string = $pessoa_vaga_pessoa_to_string;
        }

        $this->vdata['pessoa_vaga_pessoa_to_string'] = $this->pessoa_vaga_pessoa_to_string;
    }

    public function get_pessoa_vaga_pessoa_to_string()
    {
        if(!empty($this->pessoa_vaga_pessoa_to_string))
        {
            return $this->pessoa_vaga_pessoa_to_string;
        }
    
        $values = PessoaVaga::where('vaga_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->id}');
        return implode(', ', $values);
    }

    public function set_pessoa_vaga_vaga_to_string($pessoa_vaga_vaga_to_string)
    {
        if(is_array($pessoa_vaga_vaga_to_string))
        {
            $values = Vaga::where('id', 'in', $pessoa_vaga_vaga_to_string)->getIndexedArray('id', 'id');
            $this->pessoa_vaga_vaga_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_vaga_vaga_to_string = $pessoa_vaga_vaga_to_string;
        }

        $this->vdata['pessoa_vaga_vaga_to_string'] = $this->pessoa_vaga_vaga_to_string;
    }

    public function get_pessoa_vaga_vaga_to_string()
    {
        if(!empty($this->pessoa_vaga_vaga_to_string))
        {
            return $this->pessoa_vaga_vaga_to_string;
        }
    
        $values = PessoaVaga::where('vaga_id', '=', $this->id)->getIndexedArray('vaga_id','{vaga->id}');
        return implode(', ', $values);
    }

    
}

