<?php

namespace App\Controllers;

use App\Services\SkillService;
use utils\View;
use App\Services\ProfileService;
use App\Models\Skill;
use App\Services\AuthService;
use utils\Logger;

class SkillController{
    private $skillService;
    public $profileService;
    public $authService;
    public $skill;
    protected $connection;

    public function __construct(SkillService $skillService){
        $this->skillService = $skillService;    
        $this->skill = new Skill();
        $this->profileService = new ProfileService();
        $this->connection = $this->skill->getConnection();
        $this->authService = AuthService::getInstance();
    }

    public function index(){
        $skills = $this->skillService->getAllSkills();
        View::render('/skills/index.php', 'Skills', ['skills' => $skills]);
    }

    public function skillList(){
        $skills = $this->skillService->getAllSkills();
        View::render('/skills/skill_list.php', 'Skill List', ['skills' => $skills]);
    }

    public function create(){
        View::render('/skills/create_skill.php', 'Create Skill');
    }

    public function store(){
        $request = [
            'name' => isset($_POST['name']) ? trim($_POST['name']) : null,
            'description' => isset($_POST['description']) ? trim($_POST['description']) : null
        ];

        if(empty($request['name'])){
            echo "Name field is required";
            return;
        }
        
        $this->connection->beginTransaction();

        try{
            $this->skillService->createNewSkill($request);
            $userId = $this->authService->getAuthId();
            $this->profileService->updateSkillStatus($userId);
            $this->connection->commit();
            header('Location: /skills');
            exit;
        }
        catch(\Exception $e){
            $this->connection->rollback();
            Logger::error('There is some issue with adding skill', $e->getMessage());
            echo "An error occurred with skill adding. Please try again later.";
        }
        

       
    }

    public function edit($id){
        $skill = $this->skillService->getSkillById($id);
        View::render('/skills/edit.php', 'Edit Skill', ['skill' => $skill]);
    }

    public function update($id, $request){
        $this->skillService->updateSkill($id, $request->all());
    }

    public function destroy($id){
        $this->skillService->deleteSkill($id);
    }   
}