<?php

namespace  App\Services;

use App\Interfaces\SkillInterface;
use App\Models\Skill;
use utils\Logger;

class SkillService implements SkillInterface{
    public function createNewSkill(array $request): Skill{
     
        if(empty($request['name'])){
            throw new \Exception('Name is required');
        }
        if(empty($request['description'])){
            throw new \Exception('Description is required');
        }

        return Skill::create([
            'name' => $request['name'],
            'description' => $request['description']
        ]);
    }

    public function getAllSkills(): array{
        return Skill::all()->toArray();
    }

    public function getSkillById(int $id): array{
        return Skill::find($id);
    }

    public function updateSkill(int $id, array $request) : Skill {
        $skill = Skill::find($id);
        $skill->name = $request['name'];
        $skill->description = $request['description'];
        $skill->save();
        return $skill;
    }           


    public function deleteSkill(int $id): void{
        $skill = Skill::find($id);
        $skill->delete();
    }       
}