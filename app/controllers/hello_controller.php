<?php
class HelloController extends AppController
{
    public function index()
    {
		if (!Fangate::isFan()) {
			// リダイレクト
			header("Location: hello/nofan");
			exit();
		}
    }
	
	public function nofan()
	{
	}
}
