<?php

class FatPessoaAreaAtuacaoHabilidade extends TRecord
{
    const TABLENAME  = 'fat_pessoa_area_atuacao_habilidade';
    const PRIMARYKEY = 'pessoa_ai';
    const IDPOLICY   =  'max'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('pessoa_nome');
        parent::addAttribute('pessoa_fone');
        parent::addAttribute('pessoa_celular');
        parent::addAttribute('pessoa_email');
        parent::addAttribute('pessoa_curriculo');
            
    }

    
}

