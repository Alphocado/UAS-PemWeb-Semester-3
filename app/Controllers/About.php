<?php namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tentang Kami',
            'sub'   => 'Melestarikan kuliner Makassar melalui edukasi digital',
            'summary' => 'Website ini dikembangkan oleh mahasiswa Program Pendidikan Teknik Informatika & Komputer (PTIK) Universitas Negeri Makassar sebagai media edukasi dan pelestarian kuliner khas Makassar. Konten meliputi sejarah, resep, dan galeri yang dikurasi dan diverifikasi.',
            'vision' => 'Menjadi arsip digital terpercaya untuk kuliner tradisional Makassar.',
            'missions' => [
                'Mengedukasi publik tentang sejarah dan filosofi kuliner Makassar.',
                'Mendokumentasikan resep tradisional agar tidak hilang ditelan waktu.',
                'Memberi ruang bagi komunitas untuk berbagi foto dan pengalaman kuliner.'
            ],
            'team' => [
                ['name'=>'Suci Sindi Wulanasari','role'=>'Frontend Developer','img'=>base_url('assets/img/member/default.jpg'),'contact'=>'sucisindiwulansari@gmail.com'],
                ['name'=>'Nur Salmi','role'=>'Backend Developer','img'=>base_url('assets/img/member/default.jpg'),'contact'=>'nurs94207@gmail.com'],
                ['name'=>'Magfirah Ahmad','role'=>'Content & Research','img'=>base_url('assets/img/member/default.jpg'),'contact'=>'magfirahahmad93@gmail.com'],
                ['name'=>'Raynato Lienardy','role'=>'Project Lead & Fullstack','img'=>base_url('assets/img/member/default.jpg'),'contact'=>'raylienardy@gmail.com']
            ],
            'references' => [
                ['title'=>'Adu et al., 2022','url'=>'https://example.com/adu2022'],
                ['title'=>'Rozi et al., 2024','url'=>'https://example.com/rozi2024']
            ]
        ];
        
        echo view('layout/header', $data);
        echo view('about', $data);
        echo view('layout/footer');
    }
}
