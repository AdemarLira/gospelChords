function validarFormulario(){
    var nome = document.getElementById('nome').value.trim();
    var email = document.getElementById('email').value.trim();
    var senha = document.getElementById('senha').value.trim();
    var celular = document.getElementById('celular').value.trim();
    var cidade = document.getElementById('cidade').value.trim();
    var estado = document.getElementById('estado').value.trim();
    
    if(nome === "" || email === "" || senha === "" || celular === "" || cidade === "" || estado === ""){
      alert("Todos os campos são obrigatórios!");
    return false;
    }

    if (email.indexOf('@') === -1 || email.indexOf('.') === -1 || email.startsWith('@') || email.endsWith('.') || email.indexOf('@') > email.lastIndexOf('.')) {
      alert("Por favor, insira um email válido!");
      return false; 
    }
    
    if (senha.length < 8 ){
      alert("A senha deve conter pelo menos 8 caracteres!")
      return false;
    }
      return true; 
    }

function verificarPlanos() {
  window.location.href = 'planos.php';
}

function voltarIndex(){
  window.location.href = 'index.php';
}

function enviarCifra() {
  const musica = document.getElementById('nome_musica').value;
  const autor = document.getElementById('autor').value;
  const versao = document.getElementById('versao').value;
  const tipo = document.querySelector('input[name="radioDefault"]:checked').nextElementSibling.textContent.trim();
  const arquivo = document.getElementById('upload_cifra').files[0];

  if (!musica || !autor || !versao || !arquivo) {
    alert("Preencha todos os campos e selecione um arquivo.");
    return;
  }

  const formData = new FormData();
    formData.append('musica', musica);
    formData.append('autor', autor);
    formData.append('versao', versao);
    formData.append('tipo', tipo);
    formData.append('arquivo', arquivo);

  fetch('/api/envioCifra.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(result => {
    alert('Cifra enviada com sucesso!');
    // Aqui você pode fechar o modal ou limpar o formulário, se desejar
  })
  .catch(error => {
    console.error('Erro:', error);
    alert('Erro ao enviar cifra.');
  });
}