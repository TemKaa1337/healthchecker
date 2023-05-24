This project allows you to set rules how to monitor health of your services.

This is simple project which provides interfaces for running tasks.

# Quickstart
For example, you want to check if your service returns 200 HTTP status code.
Then you need to write two classes for this.  
1st - ServiceRuleResult class.
```
<?php declare(strict_types = 1);

use HealthChecker\Contracts\RuleResult;

final readonly class ServiceRuleResult implements RuleResult
{
    public function __construct(
        private bool $success,
        private string $name,
        private string|null $description,
        private string|null $error
    ) {}
    
    // And other methods from RuleResult interface
}
```

2nd - ServiceHealth class.
```
<?php declare(strict_types = 1);

use HealthChecker\HealthChecker;
use HealthChecker\Contracts\Rule;
use HealthChecker\Contracts\RuleResult;

final readonly class ServiceHealth implements Rule
{
    public function __construct(
        private string $url 
    ) {}
    
    public function run(): RuleResult
    {
        // Execute your logic here and return ServiceRuleResult
        return new ServiceRuleResult(
            true,
            'service check',
            'Checks if service is reachable',
            null
        );
    }
}
```
Finally, you should instantiate HealthChecker object and get results.
```
// Client code

$rules = [new ServiceHealth('www.ecaple.com')];
$checker = new HealthChecker\HealthChecker($rules);
// Here you get array of objects which implement RuleResult interface
$result = $checker->run();
```