<?php

namespace Aisasemi\SRI;

class SRI
{
    private $sri = [];
    private $mix = [];
    private $filename = '';
    private $mixfilename = '';
    private $algorithm = 'sha512';
    public function __construct() {
        $this->filename = \public_path('sri-manifest.json');
        $this->mixfilename = \public_path('mix-manifest.json');
        $this->load();
    }
    public function load()
    {
        if (\file_exists($this->filename)) {
            $this->sri = \json_decode(\file_get_contents($this->filename), true);
        }
        if (\file_exists($this->mixfilename)) {
            $this->mix = \json_decode(\file_get_contents($this->mixfilename), true);
        }
    }
    public function save() {
        \file_put_contents($this->filename, \json_encode($this->sri));
    }
    public function get($asset)
    {
        if (isset($this->sri[$asset])) {
            return $this->sri[$asset];
        } elseif (isset($this->mix[$asset])) {
            return $this->get(explode('?', $this->mix[$asset])[0]);
        } elseif (\file_exists(\public_path($asset)) || in_array(explode('://', strtolower($asset))[0], ['http', 'https'])) {
            $b64_hash = \base64_encode(\hash($this->algorithm, \file_get_contents(\public_path($asset)), true));
            $this->sri[$asset] = "{$this->algorithm}-{$b64_hash}";
            $this->save();
            return $this->sri[$asset];
        }
        return null;
    }
    public function html($asset, $crossorigin = 'anonymous') {
        $ext = pathinfo($asset, PATHINFO_EXTENSION);
        $asset_url = $asset;
        if (isset($this->mix[$asset])) {
            $asset_url = $this->mix[$asset];
        }
        if (!in_array(explode('://', strtolower($asset))[0], ['http', 'https'])) {
            $asset_url = \asset($asset);
        }
        switch($ext) {
            case 'css':
                return "<link rel='stylesheet' href='{$asset_url}' integrity='{$this->get($asset)}' crossorigin='{$crossorigin}'>";
                break;
            case 'js':
                return "<script src='{$asset_url}' integrity='{$this->get($asset)}' crossorigin='{$crossorigin}'></script>";
                break;
        }
    }
}
