<?php

class Utils
{
    const SIM = 'S';
    const NAO = 'N';
    
    public static function round2($value)
    {
        return self::roundTo($value, 2);
    }
    
    public static function roundTo($value, $decimals)
    {
        return round($value, $decimals);
    }
    
    public static function toFloat($value)
    {
        return (float)str_replace(['.',','],['','.'],$value);
    }
    
    public static function toMonetary($value, $casas=2)
    {
        if (! is_numeric($casas)){
            $casas = 2;
        }
        return number_format((float)$value,$casas,',','.');
    }
    
    public static function encodeActionURL(TAction $action)
    {
        list($classe,$metodo) = explode('::',$action->toString());
        $dados = ['classe'=>$classe,'metodo'=>$metodo,'param'=>$action->getParameters()??[]];
        
        return base64_encode(json_encode($dados));
    }

    public static function decodeActionURL($dados)
    {
        $dados_redirect = (array)json_decode(base64_decode($dados));
        
        return new TAction([$dados_redirect['classe'],$dados_redirect['metodo']],(array)$dados_redirect['param']);
    }
    
    static function soNumeros($valor)
    {
        $numeros = preg_replace("/[^0-9]/", "", $valor);

        return $numeros;
    }

    static function soNumerosLetras($valor)
    {
        $numeros = preg_replace("/[^0-9a-zA-z]/", "", $valor);

        return $numeros;
    }
    
    static function tiraAcento( $texto )
    {
        return str_replace(['ç','Ç','ã','Ã','Â','â','Ê','ê','Ô','ô','ä','Ä','ë','Ë','ö','Ö','ü','õ','Õ','á','Á','é','É','í','Í','ó','Ó','ú','Ú','º','ª','°'],
                           ['c','C','a','A','A','a','E','e','O','o','a','A','e','E','o','O','U','o','O','a','A','e','E','i','I','o','O','u','U','','',''],
                           $texto);
    }
    
    static function formatMask($mask, $value)
    {
        if ($value)
        {
            $value_index  = 0;
            $clear_result = '';
        
            $value = preg_replace('/[^a-z\d]+/i', '', $value);
            
            for ($mask_index=0; $mask_index < strlen($mask); $mask_index ++)
            {
                $mask_char = substr($mask, $mask_index,  1);
                $text_char = substr($value, $value_index, 1);
        
                if (in_array($mask_char, array('-', '_', '.', '/', '\\', ':', '|', '(', ')', '[', ']', '{', '}', ' ')))
                {
                    $clear_result .= $mask_char;
                }
                else
                {
                    $clear_result .= $text_char;
                    $value_index ++;
                }
            }
            return $clear_result;
        }
    }
    
    static function exibeSimNao($valor)
    {
        return $valor == 'S' ? 'Sim' : 'Não';
    }
    
    static function getProximoDiaUtil($data)
    {
        $dia_semana = date('N',strtotime($data));
        
        $critFeriado = new TCriteria();
        $critFeriado->add(new TFilter('dt_feriado','=',$data));
        $critFixo = new TCriteria();
        $critFixo->add(new TFilter('fixo','=','S'));
        $critFixo->add(new TFilter('substr(dt_feriado::text,6)','=',substr($data,5)));
        
        $critFeriado->add($critFixo,TExpression::OR_OPERATOR);
        
        $feriado = Feriado::getObjects($critFeriado);
        
        if ($feriado OR $dia_semana > 5)
        {
            $proxima_data = new DateTime($data);
            $proxima_data->add(new DateInterval('P1D'));
            
            $data = self::getProximoDiaUtil($proxima_data->format('Y-m-d'));
        }
        
        return $data;
    }
    
    static function simNaoArray()
    {
        return ['S'=>'Sim','N'=>'Não'];
    }
    
    static function getStatusImage($color,$label,$icone=null)
    {
        if ($icone)
        {
            $img = new TElement('i');
            $img->class = $icone;
            $img->style = 'color: ' . $color;
            $img->title = $label;
        }
        else
        {
            $img = new TElement('svg');
            $img->width = '15';
            $img->height = '15';
            $img->title = $label;
            
            $circle = new TElement('circle');
            $circle->fill = $color;
            $circle->cx = '8';
            $circle->cy = '8';
            $circle->r = '7';
            
            $img->add($circle);
        }
        return $img;
    }
}