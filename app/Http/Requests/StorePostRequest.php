<?php

namespace SayWebSolutions\LetsBlog\Http\Requests;

use SayWebSolutions\LetsBlog\LetsBlog;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $table = config('letsblog.table.prefix').'_posts';

        $rules = [
        'title' => "required|unique:{$table}",
        'slug' => "required|unique:{$table}",
        'keywords' => 'required',
        'meta' => 'required',
        'body' => 'required'
        ];

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
              return [];
            }

            case 'POST':
            {

                return $rules;

            }

            case 'PUT':
            case 'PATCH':
            {

                $rules['title'] .= ',id,' . $this->posts;
                $rules['slug'] .= ',id,' . $this->posts;

              return $rules;

            }

            default:
                break;
        }
    }
}
