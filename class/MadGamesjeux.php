<?php

declare(strict_types=1);

require_once XOOPS_ROOT_PATH . '/class/module.errorhandler.php';

class Jeux
{
    public $db;

    public $table;

    public $id;

    public $cid;

    public $url_img;

    public $nom;

    public $description;

    public $url_swf;

    public $width;

    public $height;

    public function __construct($id = 0)
    {
        $this->db = XoopsDatabaseFactory::getDatabaseConnection();

        $this->table = $this->db->prefix('madgames');

        if (is_array($id)) {
            $this->makeJeux($id);
        } elseif (0 != $id) {
            $this->loadJeux($id);
        } else {
            $this->id = $id;
        }
    }

    public function SetCid($value)
    {
        $this->cid = $value;
    }

    public function SetNom($value)
    {
        $this->nom = $value;
    }

    public function SetDescription($value)
    {
        $this->description = $value;
    }

    public function SetUrl_img($value)
    {
        $this->url_img = $value;
    }

    public function SetUrl_swf($value)
    {
        $this->url_swf = $value;
    }

    public function SetWidth($value)
    {
        if (0 == $value) {
            $this->width = 600;
        } else {
            $this->width = $value;
        }
    }

    public function SetHeight($value)
    {
        if (0 == $value) {
            $this->height = 450;
        } else {
            $this->height = $value;
        }
    }

    public function loadJeux($id)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id=' . $id . ' ORDER BY nom';

        $array = $this->db->fetchArray($this->db->query($sql));

        $this->makeJeux($array);
    }

    public function makeJeux($array)
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

    public function cid()
    {
        return $this->cid;
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

    public function description($format = 'S')
    {
        if (!isset($this->description)) {
            return '';
        }

        $myts = MyTextSanitizer::getInstance();

        switch ($format) {
            case 'S':
                $description = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5);
                break;
            case 'E':
                $description = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5);
                break;
            case 'P':
                $description = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5);
                break;
            case 'F':
                $description = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5);
                break;
        }

        return $description;
    }

    public function url_img($format = 'S')
    {
        if (!isset($this->url_img)) {
            return '';
        }

        $myts = MyTextSanitizer::getInstance();

        switch ($format) {
            case 'S':
                $url_img = htmlspecialchars($this->url_img, ENT_QUOTES | ENT_HTML5);
                break;
            case 'E':
                $url_img = htmlspecialchars($this->url_img, ENT_QUOTES | ENT_HTML5);
                break;
            case 'P':
                $url_img = htmlspecialchars($this->url_img, ENT_QUOTES | ENT_HTML5);
                break;
            case 'F':
                $url_img = htmlspecialchars($this->url_img, ENT_QUOTES | ENT_HTML5);
                break;
        }

        return $url_img;
    }

    public function url_swf($format = 'S')
    {
        if (!isset($this->url_swf)) {
            return '';
        }

        $myts = MyTextSanitizer::getInstance();

        switch ($format) {
            case 'S':
                $url_swf = htmlspecialchars($this->url_swf, ENT_QUOTES | ENT_HTML5);
                break;
            case 'E':
                $url_swf = htmlspecialchars($this->url_swf, ENT_QUOTES | ENT_HTML5);
                break;
            case 'P':
                $url_swf = htmlspecialchars($this->url_swf, ENT_QUOTES | ENT_HTML5);
                break;
            case 'F':
                $url_swf = htmlspecialchars($this->url_swf, ENT_QUOTES | ENT_HTML5);
                break;
        }

        return $url_swf;
    }

    public function width()
    {
        return $this->width ?? 600;
    }

    public function height()
    {
        return $this->height ?? 450;
    }

    public function store()
    {
        global $myts;

        $myts = MyTextSanitizer::getInstance();

        if (isset($this->cid) && 0 != $this->cid) {
            $cid = $this->cid;
        }

        if (isset($this->nom) && '' != $this->nom) {
            $nom = $myts->addSlashes($this->nom);
        }

        if (isset($this->description) && '' != $this->description) {
            $description = $myts->addSlashes($this->description);
        }

        if (isset($this->url_img) && '' != $this->url_img) {
            $url_img = $myts->addSlashes($this->url_img);
        }

        if (isset($this->url_swf) && '' != $this->url_swf) {
            $url_swf = $myts->addSlashes($this->url_swf);
        }

        if (isset($this->width) && 0 != $this->width) {
            $width = $this->width;
        }

        if (isset($this->height) && 0 != $this->height) {
            $height = $this->height;
        }

        if (empty($this->id)) {
            $this->id = $this->db->genId($this->table . '_id_seq');

            $sql = 'INSERT INTO '
                        . $this->table
                        . ' (id, cid, nom, description, url_img, url_swf, width, height ) VALUES ('
                        . $this->id
                        . ', '
                        . $this->cid
                        . ", '"
                        . $this->nom
                        . "', '"
                        . $this->description
                        . "', '"
                        . $this->url_img
                        . "', '"
                        . $this->url_swf
                        . "', "
                        . $this->width
                        . ', '
                        . $this->height
                        . ')';
        } else {
            $sql = 'UPDATE ' . $this->table . ' SET cid=' . $cid . ", nom='" . $nom . "', description='" . $description . "', url_img='" . $url_img . "', url_swf='" . $url_swf . "', width=" . $width . ', height=' . $height . '  WHERE id=' . $this->id . ' ';
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
