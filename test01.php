<?php






#[Attribute]
class Role {
    private $data1;
    private $data2;
    
    function __construct($data1,$data2) {
        echo "Pter construct";
        $this->data1=$data1;
        $this->data2=$data2;
        
    }
}

class CopyFile 
{
    public string $fileName;
    public string $targetDirectory;

    #[SetUp]
    public function fileExists()
    {
        if (!file_exists($this->fileName)) {
            throw new RuntimeException("File does not exist");
        }
    }

    #[SetUp]
    public function targetDirectoryExists()
    {
        if (!file_exists($this->targetDirectory)) {
            mkdir($this->targetDirectory);
        } elseif (!is_dir($this->targetDirectory)) {
            throw new RuntimeException("Target directory $this->targetDirectory is not a directory");
        }
    }
    
    #[Role('Connected')]
    public function displayPlop() {
        echo "PLOPi".PHP_EOL;
    }

    public function execute()
    {
        //var_dump($this->fileName, $this->targetDirectory . '/' . basename($this->fileName));
        copy($this->fileName, $this->targetDirectory . '/' . basename($this->fileName));
    }
}

function executeAction($actionHandler)
{
    $reflection = new ReflectionObject($actionHandler);
   
    foreach ($reflection->getMethods() as $method) {
        
        $attributes = $method->getAttributes(Role::class);
        foreach ($attributes as $attribute) {
            var_dump($attribute->getArguments());
        }
        if (count($attributes) > 0) {
            $methodName = $method->getName();

            $actionHandler->$methodName();
        }
        
        
        
        
    }
    
    

    $actionHandler->execute();
}

$copyAction = new CopyFile();
$copyAction->fileName = "/home/pter/html/toto.php";
$copyAction->targetDirectory = "/home/pter/html/target";

executeAction($copyAction);