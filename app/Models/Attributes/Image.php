<?php namespace App\Models\Attributes;

class Image
{
    /**
     * @var string
     */
    protected $directory;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $file_path;

    /**
     * @var array
     */
    protected $info = [];

    protected $parent_id = null;

    protected $prefix = '';

    /**
     * Image constructor.
     * @param $file_path
     */
    public function __construct($file_path, $prefix = '', $parent_id = null)
    {
        $this->file_path = $file_path;
        $this->info = $this->info();

        if ($parent_id) {
            $this->parent_id = $parent_id;
        }

        if ($prefix) {
            $this->prefix = $prefix;
        }

        if ($this->info) {
            $this->filename = $this->info['name'];
        }
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->file_path;
    }

    /**
     * @return string
     */
    public function getFullPath()
    {
        return !empty($this->file_path) ? public_path($this->file_path) : null;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->filename . '.' . $this->info['extension'];
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return \File::exists($this->getFullPath());
    }

    /**
     * @return array
     */
    public function info()
    {
        if ($this->info) {
            return $this->info;
        }

        $file = $this->getFullPath();

        if (!$this->exists()) return '';

        list($width, $height) = getimagesize($file);
        $extension = \File::extension($file);
        $name = \File::name($file);
        $info = [
            'extension' => $extension,
            'name' => $name,
            'width' => $width,
            'height' => $height
        ];
        return $info;
    }

    /**
     * @param $template
     * @return string
     */
    public function thumbnail($template)
    {
        $path = '';
        if ($this->prefix) {
            $path = $this->prefix . '/';
        }

        if ($this->parent_id) {
            $path .= $this->parent_id . '/';
        }

        $path .= $this->getFileName();
        return route('imagecache', [$template, $path]);
    }

    /**
     * @return void
     */
    public function delete()
    {
        if (!$this->exists()) return;
        \File::delete($this->getFullPath());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->file_path;
    }
}