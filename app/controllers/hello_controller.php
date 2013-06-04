<?php
class HelloController extends AppController
{
    public function index()
    {
		if (Fungate::isFun()) {
			$this->redirect('hello/nofun');
		}
    }
	
	public function nofun()
	{
	}
}
