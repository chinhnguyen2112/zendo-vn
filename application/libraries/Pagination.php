<?php

class Pagination
{
    protected $_config = array(
        'current_page'  => 1,
        'total_record'  => 1,
        'total_page'    => 1,
        'limit'         => 9,
        'start'         => 9,
        'link_full'     => '',
        'link_first'    => '',
        'range'         => 5,
        'min'           => 0,
        'max'           => 0
    );
    function init($config = array())
    {
        foreach ($config as $key => $val) {
            if (isset($this->_config[$key])){
                $this->_config[$key] = $val;
            }
        }
        if ($this->_config['limit'] < 0) {
            $this->_config['limit'] = 0;
        }
        $this->_config['total_page'] = ceil($this->_config['total_record'] / $this->_config['limit']);
        if (!$this->_config['total_page']) {
            $this->_config['total_page'] = 1;
        }
        if ($this->_config['current_page'] < 1) {
            $this->_config['current_page'] = 1;
        }
         
        if ($this->_config['current_page'] > $this->_config['total_page']) {
            $this->_config['current_page'] = $this->_config['total_page'];
        }
        $this->_config['start'] = ($this->_config['current_page'] - 1) * $this->_config['limit'];
        $middle = ceil($this->_config['range'] / 2);
        if ($this->_config['total_page'] < $this->_config['range']) {
            $this->_config['min'] = 1;
            $this->_config['max'] = $this->_config['total_page'];
        } else {
            $this->_config['min'] = $this->_config['current_page'] - $middle + 1;
            $this->_config['max'] = $this->_config['current_page'] + $middle - 1;
            if ($this->_config['min'] < 1) {
                $this->_config['min'] = 1;
                $this->_config['max'] = $this->_config['range'];
            } else if ($this->_config['max'] > $this->_config['total_page']) {
                $this->_config['max'] = $this->_config['total_page'];
                $this->_config['min'] = $this->_config['total_page'] - $this->_config['range'] + 1;
            }
        }
    }
    private function __link($page)
    {
        if ($page <= 1 && $this->_config['link_first']) {
            return $this->_config['link_first'];
        }
        return str_replace('{page}', $page, $this->_config['link_full']);
    }

    function html_acc()
    {   
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<div class="page_account"> ';
            if ($this->_config['current_page'] > 1) {
                $p .= ' <p onclick="page = 1;load_acc()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></p> ';
                //$p .= ' <p onclick="page='.($this->_config['current_page'] - 1).';load_account()"><i class="fa fa-angle-left" aria-hidden="true"></i></li> ';
            }
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
                if ($this->_config['current_page'] == $i) {
                    $p .= ' <p onclick="page='.$i.';load_acc()" class="active">'.$i.'</p> ';
                } else {
                    $p .= ' <p onclick="page='.$i.';load_acc()">'.$i.'</p> ';
                }
            }
            if ($this->_config['current_page'] < $this->_config['total_page']) {
                //$p .= ' <p onclick="page='.($this->_config['current_page'] + 1).';load_account()"><i class="fa fa-angle-right" aria-hidden="true"></i></p> ';
                $p .= ' <p onclick="page='.$this->_config['total_page'].';load_acc()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></p> ';
            }
            $p .= '</div>';
        }
        return $p;
    }
    
    function html_blog()
    {   
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<div class="page_account"> ';
            if ($this->_config['current_page'] > 1) {
                $p .= ' <p onclick="page = 1;load_blog()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></p> ';
                //$p .= ' <p onclick="page='.($this->_config['current_page'] - 1).';load_account()"><i class="fa fa-angle-left" aria-hidden="true"></i></li> ';
            }
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
                if ($this->_config['current_page'] == $i) {
                    $p .= ' <p onclick="page='.$i.';load_blog()" class="active">'.$i.'</p> ';
                } else {
                    $p .= ' <p onclick="page='.$i.';load_blog()">'.$i.'</p> ';
                }
            }
            if ($this->_config['current_page'] < $this->_config['total_page']) {
                //$p .= ' <p onclick="page='.($this->_config['current_page'] + 1).';load_account()"><i class="fa fa-angle-right" aria-hidden="true"></i></p> ';
                $p .= ' <p onclick="page='.$this->_config['total_page'].';load_blog()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></p> ';
            }
            $p .= '</div>';
        }
        return $p;
    }
    
    function html_member()
    {   
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<div class="page_account"> ';
            if ($this->_config['current_page'] > 1) {
                $p .= ' <p onclick="page = 1;load_account_member()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></p> ';
                //$p .= ' <p onclick="page='.($this->_config['current_page'] - 1).';load_account()"><i class="fa fa-angle-left" aria-hidden="true"></i></li> ';
            }
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
                if ($this->_config['current_page'] == $i) {
                    $p .= ' <p onclick="page='.$i.';load_account_member()" class="active">'.$i.'</p> ';
                } else {
                    $p .= ' <p onclick="page='.$i.';load_account_member()">'.$i.'</p> ';
                }
            }
            if ($this->_config['current_page'] < $this->_config['total_page']) {
                //$p .= ' <p onclick="page='.($this->_config['current_page'] + 1).';load_account()"><i class="fa fa-angle-right" aria-hidden="true"></i></p> ';
                $p .= ' <p onclick="page='.$this->_config['total_page'].';load_account_member()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></p> ';
            }
            $p .= '</div>';
        }
        return $p;
    }
    
    function html_card()
    {   
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<div class="page_account"> ';
            if ($this->_config['current_page'] > 1) {
                $p .= ' <p onclick="page2 = 1;load_history_card()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></p> ';
                //$p .= ' <p onclick="page='.($this->_config['current_page'] - 1).';load_account()"><i class="fa fa-angle-left" aria-hidden="true"></i></li> ';
            }
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
                if ($this->_config['current_page'] == $i) {
                    $p .= ' <p onclick="page2='.$i.';load_history_card()" class="active">'.$i.'</p> ';
                } else {
                    $p .= ' <p onclick="page2='.$i.';load_history_card()">'.$i.'</p> ';
                }
            }
            if ($this->_config['current_page'] < $this->_config['total_page']) {
                //$p .= ' <p onclick="page='.($this->_config['current_page'] + 1).';load_account()"><i class="fa fa-angle-right" aria-hidden="true"></i></p> ';
                $p .= ' <p onclick="page2='.$this->_config['total_page'].';load_history_card()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></p> ';
            }
            $p .= '</div>';
        }
        return $p;
    }
    
    function html_pre()
    {   
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<div class="page_account"> ';
            if ($this->_config['current_page'] > 1) {
                $p .= ' <p onclick="page3 = 1;load_history_pre()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></p> ';
                //$p .= ' <p onclick="page='.($this->_config['current_page'] - 1).';load_account()"><i class="fa fa-angle-left" aria-hidden="true"></i></li> ';
            }
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
                if ($this->_config['current_page'] == $i) {
                    $p .= ' <p onclick="page3='.$i.';load_history_pre()" class="active">'.$i.'</p> ';
                } else {
                    $p .= ' <p onclick="page3='.$i.';load_history_pre()">'.$i.'</p> ';
                }
            }
            if ($this->_config['current_page'] < $this->_config['total_page']) {
                //$p .= ' <p onclick="page='.($this->_config['current_page'] + 1).';load_account()"><i class="fa fa-angle-right" aria-hidden="true"></i></p> ';
                $p .= ' <p onclick="page3='.$this->_config['total_page'].';load_history_pre()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></p> ';
            }
            $p .= '</div>';
        }
        return $p;
    }
    
    function html_buy()
    {   
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<div class="page_account"> ';
            if ($this->_config['current_page'] > 1) {
                $p .= ' <p onclick="page = 1;load_history_buy()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></p> ';
                //$p .= ' <p onclick="page='.($this->_config['current_page'] - 1).';load_account()"><i class="fa fa-angle-left" aria-hidden="true"></i></li> ';
            }
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
                if ($this->_config['current_page'] == $i) {
                    $p .= ' <p onclick="page='.$i.';load_history_buy()" class="active">'.$i.'</p> ';
                } else {
                    $p .= ' <p onclick="page='.$i.';load_history_buy()">'.$i.'</p> ';
                }
            }
            if ($this->_config['current_page'] < $this->_config['total_page']) {
                //$p .= ' <p onclick="page='.($this->_config['current_page'] + 1).';load_account()"><i class="fa fa-angle-right" aria-hidden="true"></i></p> ';
                $p .= ' <p onclick="page='.$this->_config['total_page'].';load_history_buy()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></p> ';
            }
            $p .= '</div>';
        }
        return $p;
    }
    
    function html_site()
    {   
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<div class="page_account"> ';
            if ($this->_config['current_page'] > 1) {
                $p .= ' <p onclick="page='.($this->_config['current_page'] - 1).';load_account()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></p> ';
                //$p .= ' <p onclick="page = 1;load_account()">1</p> ';
            }
            if($this->_config['current_page'] > 3){
            //$p .= ' <p onclick="">...</p> ';
            }            
            for ($i = $this->_config['min']; $i <= $this->_config['max']-1; $i++) {
                if ($this->_config['current_page'] == $i) {
                    $p .= ' <p onclick="page='.$i.';load_account()" class="active">'.$i.'</p> ';
                } else {
                    $p .= ' <p onclick="page='.$i.';load_account()">'.$i.'</p> ';
                }
            }
            if($this->_config['current_page'] < $this->_config['total_page'] - 2){
            $p .= ' <p onclick="">...</p> ';
            }
            if ($this->_config['current_page'] <= $this->_config['total_page']) {
                if ($this->_config['current_page'] == $this->_config['total_page']) {
                $p .= ' <p onclick="page='.$this->_config['total_page'].';load_account()" class="active">'.$this->_config['total_page'].'</p>';
                }else{
                $p .= ' <p onclick="page='.$this->_config['total_page'].';load_account()">'.$this->_config['total_page'].'</p>';
                }
                $p .= ' <p onclick="page='.($this->_config['current_page'] + 1).';load_account()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></p> ';
                
            }
            $p .= '</div>';
        }
        return $p;
    }
    function getConfig() {
    	return $this->_config;
    }
}
?>