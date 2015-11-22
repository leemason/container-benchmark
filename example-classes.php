<?php
class a{
    public function __construct(){

    }
}
class b{
    public function __construct(a $a){
        $this->a = $a;
    }
}
class c{
    public function __construct(a $a, b $b){
        $this->a = $a;
        $this->b = $b;
    }
}
class d{
    public function __construct(a $a, b $b, c $c){
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }
}
class e{
    public function __construct(a $a, b $b, c $c, d $d){
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->d = $d;
    }
}
class f{
    public function __construct(a $a, b $b, c $c, d $d, e $e){
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->d = $d;
        $this->e = $e;
    }
}
class g{
    public function __construct(a $a, b $b, c $c, d $d, e $e, f $f){
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->d = $d;
        $this->e = $e;
        $this->f = $f;
    }
}