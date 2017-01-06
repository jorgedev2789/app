<?php

abstract class FabricaAutos
{
	abstract protected function ensamblado();
	abstract protected function tapizado();
	abstract protected function pintura();
}

class Auto extends FabricaAutos{

	public function ensamblado(){

	}
	public function tapizado(){

	}
	public function pintura(){
		
	}
}