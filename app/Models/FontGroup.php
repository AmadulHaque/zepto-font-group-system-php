<?php

namespace App\Models;

use App\Core\Model;

class FontGroup extends Model
{
    protected $table = 'font_groups';

    public function createGroup(array $data)
    {
        $groupId = $this->insertGroup($data['group_name']);
        $this->insertFontGroupFonts($groupId, $data);
        return $groupId;
    }

    protected function insertGroup(string $groupName): int
    {
        $sql = "INSERT INTO {$this->table} (group_name) VALUES (:group_name)";
        $this->query($sql, ['group_name' => $groupName]);
        return $this->getLastInsertId();
    }

    protected function insertFontGroupFonts(int $groupId, array $data)
    {
        for ($i = 0; $i < count($data['font_id']); $i++) {
            $sql = "INSERT INTO font_group_fonts (group_id, font_id, name, size, price) 
                    VALUES (:group_id, :font_id, :name, :size, :price)";
            $this->query($sql, [
                'group_id' => $groupId,
                'font_id' => $data['font_id'][$i],
                'name' => $data['name'][$i],
                'size' => $data['size'][$i],
                'price' => $data['price'][$i]
            ]);
        }
    }



    public function getGroups()
    {
        $sql = "SELECT fg.id, fg.group_name, COUNT(fgf.font_id) AS font_count
                FROM font_groups fg
                LEFT JOIN font_group_fonts fgf ON fg.id = fgf.group_id
                GROUP BY fg.id, fg.group_name";

        return $this->query($sql);
    }

    public function getFontsByGroupId($groupId)
    {
        $sql = "SELECT f.id, f.name 
                FROM font_group_fonts fgf 
                JOIN fonts f ON fgf.font_id = f.id 
                WHERE fgf.group_id = :group_id";
        
        return $this->query($sql, ['group_id' => $groupId]);
    }


    public function updateGroup(array $data)
    {
        $this->updateGroupDetails($data['group_id'], $data['group_name']);
        $this->updateFontGroupFonts($data['group_id'], $data);
    }
    
    protected function updateGroupDetails(int $groupId, string $groupName)
    {
        $sql = "UPDATE {$this->table} SET group_name = :group_name WHERE id = :group_id";
        $this->query($sql, ['group_name' => $groupName, 'group_id' => $groupId]);
    }
    
    protected function updateFontGroupFonts(int $groupId, array $data)
    {
        for ($i = 0; $i < count($data['font_id']); $i++) {
            $fontId = intval($data['font_id'][$i]);
            $sql = "UPDATE font_group_fonts 
                    SET name = :name, size = :size, price = :price 
                    WHERE group_id = :group_id AND font_id = :font_id";
            
            // Debugging output
            error_log("Updating Font ID: $fontId for Group ID: $groupId");
    
            $this->query($sql, [
                'group_id' => $groupId,
                'font_id' => 4,
                'name' => $data['name'][$i],
                'size' => $data['size'][$i],
                'price' => $data['price'][$i]
            ]);
        }
    }
    


    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->query($sql, ['id' => $id]);
        return $stmt ? $stmt[0] : null;
    }

    public function findFonts($id)
    {
        $sql = "SELECT * FROM font_group_fonts WHERE group_id = :group_id";
        $stmt = $this->query($sql, ['group_id' => $id]);
        return $stmt ? $stmt : []; // Return all fonts instead of just the first one
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->query($sql, ['id' => $id]);
    }
}
