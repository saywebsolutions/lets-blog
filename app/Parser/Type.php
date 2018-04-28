<?php

namespace SayWebSolutions\LetsBlog\Parser;

use Exception;
use SayWebSolutions\LetsBlog\Models\Post;
use Illuminate\Support\Facades\File;
use SayWebSolutions\LetsBlog\Parser\Parser;

class Type
{
    protected $path = null;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function handle()
    {
        if ( ! $path = $this->folderExists()) {
            throw new Exception('Folder "' . $this->getFullPath() . '" does not exist');
        }

        $files = File::files($path);

        $identifiers = [];

        foreach ($files as $file) {

            // pull the markdown file (post content and header meta fields)
            $fields = Parser::parse($file);

            // default to filename without extension for `identifier` field
            if ( ! isset($fields['identifier'])) {
                $fields['identifier'] = explode('.', basename($file))[0];
            }

            $data = Parser::process($fields);

            $post = Post::where('identifier', $data['identifier'])->first();

//show the matched post
//dd($post->toArray());

            // if existing post we'll update, otherwise new post
            $post = $post ? $this->update($post, $data) : $this->create($data);

            array_push($identifiers, $post->identifier);

            Parser::handle($fields, $post);
        }

        $this->delete($identifiers);
    }

    public function create($data)
    {
        $data['type'] = $this->type;

        $post = Post::create($data);
        echo 'New ' . ucfirst($this->type) . ': ' . $data['identifier'] . "\n";

        return $post;
    }

    public function update($post, $data)
    {

        $post->fill($data);
        $post->status = 'active';
        $post->type = $this->type;

        if ($post->isDirty()) {
            $post->save();
            echo 'Update ' . ucfirst($this->type) . ': ' . $data['identifier'] . "\n";
        }

        return $post;
    }

    public function delete($identifiers)
    {

        $posts = Post::whereNotIn('identifier', $identifiers)
            ->where('type', $this->type)
            ->where('status', '<>', 'deleted')
            ->get();

        Post::whereIn('id', $posts->pluck('id')->toArray())->update([
            'status' => 'deleted'
        ]);

        foreach ($posts as $p) {
            echo 'Removed ' . ucfirst($this->type) . ': ' . $p->identifier . "\n";
        }
    }

    public function getFullPath()
    {
        return $this->path . '/' . $this->folder;
    }

    public function folderExists()
    {
        $path = $this->getFullPath();

        if ( ! file_exists($path)) {
            return false;
        }

        return $path;
    }
}
