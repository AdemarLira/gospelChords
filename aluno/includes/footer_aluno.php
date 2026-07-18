<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/functions_aluno.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
      const checkbox = document.getElementById('checkbox');
      const body = document.body;

      checkbox.addEventListener('change', () => {
          if (checkbox.checked){
              body.classList.remove('light-mode');
              body.classList.add('dark-mode');
          } else{
              body.classList.remove('dark-mode');
              body.classList.add('light-mode');
          }
      });

    body.classList.add('light-mode');})


    // ALTERNACIA no conteudo do body
    function mostrarPainel(id) {
    const paineis = ['listas-musicas', 'assinaturas'];
    paineis.forEach(painel => {
      document.getElementById(painel).style.display = (painel === id) ? 'block' : 'none';
    });
  }

  function fecharPainel(id) {
    document.getElementById(id).style.display = 'none';
  }

  // Adiciona os listeners ao carregar o DOM
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btn-listas').addEventListener('click', (e) => {
      e.preventDefault();
      mostrarPainel('listas-musicas');
    });
  });
</script>
</body>
</html>