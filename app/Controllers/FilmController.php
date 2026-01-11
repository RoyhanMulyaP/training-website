<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FilmModel;

class FilmController extends BaseController
{
    protected $film;

    public function __construct()
    {
        $this->film = new FilmModel();
    }

    public function index()
    {
        return view('film/index', [
            'films' => $this->film->findAll()
        ]);
    }

    public function store()
    {
        $data = [
            'judul'     => $this->request->getPost('judul'),
            'slug'      => url_title($this->request->getPost('judul'), '-', true),
            'sutradara' => $this->request->getPost('sutradara'),
            'synopsis'  => $this->request->getPost('synopsis'),
        ];

        $coverType = $this->request->getPost('cover_type');
        if ($coverType === 'link') {
            $coverLink = $this->request->getPost('cover_link');

            if (!$coverLink) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Cover link wajib diisi'
                ])->setStatusCode(400);
            }

            $data['cover'] = $coverLink;
        }

        if ($coverType === 'upload') {
            $file = $this->request->getFile('cover_file');

            if (!$file || !$file->isValid()) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'File cover tidak valid'
                ])->setStatusCode(400);
            }

            $newName = $file->getRandomName();
            $file->move('uploads/cover', $newName);

            $data['cover'] = 'uploads/cover/' . $newName;
        }

        $this->film->insert($data);

        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }


    public function get($id)
    {
        return $this->response->setJSON(
            $this->film->find($id)
        );
    }

    public function update($id)
    {
        $model = new FilmModel();

        $data = [
            'judul'      => $this->request->getPost('judul'),
            'sutradara'  => $this->request->getPost('sutradara'),
            'synopsis'   => $this->request->getPost('synopsis'),
        ];

        $coverType = $this->request->getPost('cover_type');

        if ($coverType === 'link') {
            $coverLink = $this->request->getPost('cover_link');

            if ($coverLink) {
                $data['cover'] = $coverLink;
            }
        }

        if ($coverType === 'upload') {
            $file = $this->request->getFile('cover_file');

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/cover', $newName);

                $data['cover'] = 'uploads/cover/' . $newName;
            }
        }

        $model->update($id, $data);

        return response()->setJSON(['status' => 'success']);
    }

    public function delete($id)
    {
        $this->film->delete($id);
        return $this->response->setJSON(['status' => 'deleted']);
    }
}
