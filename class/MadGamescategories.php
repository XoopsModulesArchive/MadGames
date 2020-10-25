<?php

declare(strict_types=1);

require_once XOOPS_ROOT_PATH . '/class/module.errorhandler.php';

class Categories
{
    public $db;

    public $table;

    public $id;

    public $nom;

    public function __construct($id = 0)
    {
        $this->db = XoopsDatabaseFactory::getDatabaseConnection();

        $this->table = $this->db->prefix('madgames_categorie');

        if (is_array($id)) {
            $this->makeCategory($id);
        } elseif (0 != $id) {
            $this->loadCategory($id);
        } else {
            $this->id = $id;
        }
    }

    public function SetNom($value)
    {
        $this->nom = $value;
    }

    public function loadCategory($id)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id=' . $id . ' ORDER BY nom';

        $array = $this->db->fetchArray($this->db->query($sql));

        $this->makeCategory($array);
    }

    public function makeCategory($array)
    {
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
    }

    public function makeSelBox($varname = 'id', $preset_id = 0, $onchange = '')
    {
        $myts = MyTextSanitizer::getInstance();

        echo "<select name='" . $varname . "'";

        if ('' != $onchange) {
            echo ' onchange="' . $onchange . '"';
        }

        echo ">\n";

        $sql = "SELECT id,nom  FROM {$this->table} ORDER BY nom";

        $result = $this->db->query($sql);

        while (list($id, $nom) = $this->db->fetchRow($result)) {
            $sel = ($id == $preset_id) ? " selected='selected'" : '';

            echo "<option value='$id'$sel>" . $nom . "</option>\n";
        }

        echo "</select>\n";
    }

    public function nom($format = 'S')
    {
        if (!isset($this->nom)) {
            return '';
        }

        $myts = MyTextSanitizer::getInstance();

        switch ($format) {
            case 'S':
                $nom = htmlspecialchars($this->nom, ENT_QUOTES | ENT_HTML5);
                break;
            case 'E':
                $nom = htmlspecialchars($this->nom, ENT_QUOTES | ENT_HTML5);
                break;
            case 'P':
                $nom = htmlspecialchars($this->nom, ENT_QUOTES | ENT_HTML5);
                break;
            case 'F':
                $nom = htmlspecialchars($this->nom, ENT_QUOTES | ENT_HTML5);
                break;
        }

        return $nom;
    }

    public function store()
    {
        global $myts;

        $myts = MyTextSanitizer::getInstance();

        $nom = '';

        if (isset($this->nom) && '' != $this->nom) {
            $nom = $myts->addSlashes($this->nom);
        }

        if (empty($this->id)) {
            $this->id = $this->db->genId($this->table . '_id_seq');

            $sql = 'INSERT INTO ' . $this->table . ' (id, nom ) VALUES (' . $this->id . ", '" . $this->nom . "')";
        } else {
            $sql = 'UPDATE ' . $this->table . " SET nom='" . $nom . "' WHERE id=" . $this->id . ' ';
        }

        if (!$result = $this->db->queryF($sql)) {
            ErrorHandler::show('0022');
        }

        return true;
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id=' . $this->id . '';

        $this->db->query($sql);
    }
}
