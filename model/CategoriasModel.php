<?php
class CategoriasModel {
    // Array estático com categorias de cursos
    public static $categorias = [
        [
            'id' => 1,
            'nome' => 'Programação',
            'descricao' => 'Cursos de programação para iniciantes e avançados.',
            'quantidade_cursos' => 15
        ],
        [
            'id' => 2,
            'nome' => 'Design Gráfico',
            'descricao' => 'Aprenda a criar designs incríveis com ferramentas profissionais.',
            'quantidade_cursos' => 10
        ],
        [
            'id' => 3,
            'nome' => 'Marketing Digital',
            'descricao' => 'Estratégias de marketing para impulsionar seus negócios online.',
            'quantidade_cursos' => 12
        ],
        [
            'id' => 4,
            'nome' => 'Data Science',
            'descricao' => 'Cursos sobre análise de dados, machine learning e inteligência artificial.',
            'quantidade_cursos' => 8
        ],
        [
            'id' => 5,
            'nome' => 'Desenvolvimento Web',
            'descricao' => 'Aprenda a criar sites e aplicações web modernas.',
            'quantidade_cursos' => 20
        ]
    ];
}
?>