<?php
class HelloController extends AppController
{
    public function index()
    {
		if (!Fangate::isFan()) {
			// $B%j%@%$%l%/%H(B
			header("Location: hello/nofan");
			exit();
		}
    }
	
	public function nofan()
	{
	}
}
