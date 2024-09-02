<?php
if (!isset($_POST['data_nascimento'])){
    ?>
    <script>
        alert('Envie a sua data de nascimento corretamente!');
        location.href="./";
    </script>
    <?php
}
else{
    include('header.php');
    $dataConfere = date('m-d', strtotime($_POST['data_nascimento']));
    $signos = simplexml_load_file("signos.xml");
        foreach ($signos as $key => $value){
            $vet = explode('/', $value->dataInicio);
            $dataInicio = date('m-d', strtotime("2024-".$vet[1]."-".$vet[0]));
            $vet = explode('/', $value->dataFim);
            $dataFim = date('m-d', strtotime("2024-".$vet[1]."-".$vet[0]));
            if ($value->nomeSigno != 'Capricórnio'){
                if ($dataConfere >= $dataInicio && $dataConfere <= $dataFim){
                    $nomeSigno = $value->nomeSigno;
                    $descricao = $value->descricao;
                }
            }
            else{
                if ($dataConfere >= $dataInicio || $dataConfere <= $dataFim){         
                    $nomeSigno = $value->nomeSigno;
                    $descricao = $value->descricao;
                }
            }
        }
    ?>
    <main class="container">
    <h1><?=$nomeSigno?></h1>
    <p style="text-align: justify"><?=$descricao?></p>
    <p><a href="./" class="btn btn-danger">Voltar</a></p>
    </main>
    <?php
    include('footer.php');
}
?>