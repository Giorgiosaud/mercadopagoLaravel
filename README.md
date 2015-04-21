# mercadopagoLaravel
prueba
## change your VerifyCsrfToken to
	public function handle($request, Closure $next)
    	{
            if ($this->isReading($request) || $this->excludedRoutes($request)|| $this->tokensMatch($request))
            {
                return $this->addCookieToResponse($request, $next($request));
            }
    
            throw new TokenMismatchException;
    	}
        protected function excludedRoutes($request)
        {
            $routes = [
                'mpPayment',
            ];
    
            foreach($routes as $route)
                if ($request->is($route))
                    return true;
    
            return false;
        }
