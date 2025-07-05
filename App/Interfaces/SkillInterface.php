<?php

namespace App\Interfaces;

use App\Models\Skill;

interface SkillInterface{
    public function createNewSkill(array $request): Skill;
    public function getAllSkills(): array;
    public function getSkillById(int $id): array;
    public function updateSkill(int $id, array $request): Skill;
    public function deleteSkill(int $id): void;
}