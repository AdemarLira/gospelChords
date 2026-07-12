<?php
  include_once("api/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Criar conta | Gospel Chords</title>
<link rel="stylesheet" href="assinante/assets/css/cadastro1.css">
</head>

<body>
<div class="background-logo"></div>
  <div class="pagina">
    <header class="topo">
      <img src="assinante/assets/img/logo_amarela.png" class="logo">
        <a href="index.php" class="btn-voltar">Voltar</a>
    </header>

  <div class="cadastro-box">
    <div class="titulo">
      <h1>Criar sua conta</h1>
        <p>Faça parte da comunidade Gospel Chords 🎸</p>
      </div>
  
      <form class="form-cadastro" action="api/cadastrarUsuario.php" method="POST" enctype="multipart/form-data">
        <div class="campos">
          <div class="campo">
            <label>Nome</label>
            <input type="text" name="nome" placeholder="Digite seu nome" required>
          </div>

    <div class="campo">
      <label>Email</label>
        <input type="email" name="email" placeholder="Digite seu e-mail" required>
      </div>

    <div class="campo">
      <label>Senha</label>
      <input 
        type="password"name="senha" placeholder="Crie uma senha" required>
      </div>

    <div class="campo">
      <label>Celular</label>
        <input type="tel" id="celular" name="celular" required>
    </div>
  </div>

    <div class="linha">
          <div class="campo">
              <label>Estado</label>
              <select id="estado" name="estado" required>
                  <option value="">Selecione um estado</option>
              </select>
          </div>

          <div class="campo" id="campo-cidade" style="display:none;">
              <label>Cidade</label>
              <select id="cidade" name="cidade" required>
                  <option value="">Selecione uma cidade</option>
              </select>
          </div>
      
        <div class="campo foto">
          <label>Foto de perfil</label>
          <input type="file" name="foto"accept="image/*">
         </div>
       </div>

      <div class="campo">
      <label>Escolha seu plano</label>
        <div class="mb-3">
          <label class="form-label">Tipo de acesso</label>

          <select name="tipo_usuario" class="form-select" required>
              <option value="">Selecione</option>
              <option name="tipo_usuario" value="aluno" >Curso Completo</option>
              <option name="tipo_usuario" value="assinante">Assinante (R$ 7,00/mês)</option>
          </select>
        </div>
      </div>
      
          <div class="acoes">
              <button type="submit" class="btn-criar">
                Criar conta
              </button>

                <a href="index.php" class="btn-cancelar">
                  Cancelar
                </a>
              </div>
            </form>
          </div>
        </div>
    </div>
  <script src="admin/assets/js/functions.js"></script>
  
  <script >
 const celular = document.getElementById("celular");

    celular.addEventListener("input", function () {

        let valor = this.value.replace(/\D/g, "");

        if (valor.length > 11) {
            valor = valor.substring(0, 11);
        }

        if (valor.length > 10) {
            valor = valor.replace(
                /^(\d{2})(\d{5})(\d{4}).*/,
                "($1) $2-$3"
            );

        } else if (valor.length > 6) {
            valor = valor.replace(
                /^(\d{2})(\d{4})(\d+).*/,
                "($1) $2-$3"
            );
        } else if (valor.length > 2) {
            valor = valor.replace(
                /^(\d{2})(\d+)/,
                "($1) $2"
            );
        } else {
            valor = valor.replace(
                /^(\d*)/,
                "($1"
            );
        }
        this.value = valor;
    });

    const estado = document.getElementById("estado");
    const cidade = document.getElementById("cidade");
    const campoCidade = document.getElementById("campo-cidade");
   
    document.addEventListener("DOMContentLoaded", function () {

    // Carrega os estados
    fetch("https://servicodados.ibge.gov.br/api/v1/localidades/estados")
        .then(response => response.json())
        .then(estados => {

            estados.sort((a, b) => a.nome.localeCompare(b.nome));
            estado.innerHTML = '<option value="">Selecione um estado</option>';
            estados.forEach(item => {

                estado.innerHTML += `
                    <option value="${item.sigla}">
                        ${item.nome}
                    </option>`;
            });
          })

        .catch(error => {
            console.error("Erro ao carregar estados:", error);
            estado.innerHTML =
                '<option value="">Erro ao carregar os estados</option>';
        });

    // Quando escolher um estado
    estado.addEventListener("change", function () {

    const uf = this.value;

    if (uf === "") {
        campoCidade.style.display = "none";
        cidade.innerHTML = '<option value="">Selecione uma cidade</option>';
        return;
    }

    fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`)
        .then(response => response.json())
        .then(cidades => {

            cidade.innerHTML = '<option value="">Selecione uma cidade</option>';

            cidades.forEach(item => {
                cidade.innerHTML += `
                    <option value="${item.nome}">
                        ${item.nome}
                    </option>`;
            });
            // Exibe o campo Cidade
            campoCidade.style.display = "block";
        })
        .catch(error => {
            console.error(error);
        });
    });
  });
</script>
</body>
</html>