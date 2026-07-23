1. esqueci_senha.php
→ usuário informa o e-mail
→ sistema verifica o usuário
→ gera reset_token
→ envia o link por e-mail

2. Link enviado por e-mail
→ usuário clica
→ abre reset_senha.php?token=...

3. reset_senha.php
→ valida o token
→ mostra Nova senha
→ mostra Confirmar nova senha
→ atualiza a senha
→ invalida o token
→ redireciona para o login


app/
├─ config/
│  ├─ config.php
│  └─ database.php
├─ controllers/
│  ├─ AssinaturaController.php
│  ├─ AulaController.php
│  ├─ AuthController.php
│  ├─ CifraController.php
│  ├─ CursoController.php
│  ├─ DashboardController.php
│  ├─ FinanceiroController.php
│  ├─ ModuloController.php
│  ├─ RepertorioController.php
│  └─ UsuarioController.php
├─ helpers/
│  ├─ format.php
│  ├─ functions.php
│  ├─ session.php
│  ├─ upload.php
│  ├─ user.php
│  └─ validation.php
├─ middleware/
│  ├─ Admin.php
│  ├─ Aluno.php
│  ├─ Assinante.php
│  └─ Auth.php
├─ models/
│  ├─ Assinatura.php
│  ├─ Aula.php4
│  ├─ Cifra.php
│  ├─ Curso.php
│  ├─ Dashboard.php
│  ├─ Modulo.php
│  ├─ Repertorio.php
│  ├─ Tablatura.php
│  └─ Usuario.php
├─ services/
│  ├─ AuthService.php
│  ├─ DashboardService.php
│  ├─ EmailService.php
│  ├─ FinanceiroService.php
│  ├─ UploadService.php
│  └─ UsuarioService.php
└─ views/
   ├─ admin/
   │  ├─ cifras.php
   │  ├─ cursos.php
   │  ├─ dashboard.php
   │  ├─ financeiro.php
   │  └─ usuarios.php
   ├─ aluno/
   │  ├─ aulas.php
   │  ├─ cursos.php
   │  ├─ dashboard.php
   │  └─ repertorio.php
   ├─ assinante/
   │  ├─ cifras.php
   │  ├─ dashboard.php
   │  └─ repertorio.php
   ├─ auth/
   │  ├─ cadastro.php
   │  ├─ login.php
   │  ├─ logout.php
   │  ├─ recuperar_senha.php
   │  └─ reset_senha.php
   └─ layouts/
      ├─ dashboard_adm_consultas.php
      ├─ footer_adm.php
      ├─ footer.php
      ├─ header_adm.php
      ├─ header.php
      ├─ menu_adm.php
      ├─ navbar.php
      ├─ tabela_cifras.php
      ├─ tabela_usuarios.php
      └─ verifica_admin.php

public/
├─ admin/
│  ├─ assets/
│  │  ├─ css/
│  │  │  ├─ cadastro.css
│  │  │  ├─ dashboard_adm.css
│  │  │  ├─ dashboard_aluno.css
│  │  │  ├─ dashboard_assinante.css
│  │  │  ├─ esqueciSenha1.css
│  │  │  └─ planos1.css
│  │  ├─ img/
│  │  │  ├─ perfil/
│  │  │  │  ├─ 6a50e4f1aff55.png
│  │  │  │  ├─ 6a50e99b14f7e.png
│  │  │  │  ├─ 6a524b7a4eb43.png
│  │  │  │  ├─ 6a524bdb5d2e0.png
│  │  │  │  ├─ c4f3c3a2-8751-4378-85c2-3f555fd77ec8.jpeg
│  │  │  │  ├─ perfil.jpeg
│  │  │  │  └─ WhatsApp Image 2026-07-09 at 12.25.24.jpeg
│  │  │  ├─ logo_amarela.png
│  │  │  ├─ logo_azul.png
│  │  │  ├─ logo.png
│  │  │  └─ logo2.png
│  │  ├─ js/
│  │  │  ├─ functions_adm.js
│  │  │  └─ functions_aluno.js
│  │  └─ mp4/
│  │     ├─ cadastrar.mp4
│  │     └─ violao.mp4
│  ├─ editar_usuario.php
│  └─ excluir_usuario.php
├─ aluno/
│  └─ includes/
│     ├─ footer_aluno.php
│     ├─ header_aluno.php
│     ├─ menu_aluno.php
│     ├─ modals.php
│     └─ verifica_aluno.php
├─ api/
│  ├─ aulas/
│  │  ├─ cadastrar.php
│  │  └─ editar.php
│  ├─ auth/
│  │  ├─ login.php
│  │  ├─ recuperar_senha.php
│  │  └─ resetar_senha.php
│  ├─ cifras/
│  │  ├─ download.php
│  │  ├─ editar.php
│  │  ├─ enviar.php
│  │  └─ exluir.php
│  ├─ cursos/
│  │  ├─ cadastrar.php
│  │  ├─ editar.php
│  │  └─ exluir.php
│  ├─ modulos/
│  │  ├─ cadastrar.php
│  │  ├─ editar.php
│  │  └─ exluir.php
│  ├─ PHPMailer/
│  │  └─ src/
│  │     ├─ Exception.php
│  │     ├─ PHPMailer.php
│  │     └─ SMTP.php
│  ├─ usuarios/
│  │  ├─ alterar_status.php
│  │  ├─ atualizar_foto.php
│  │  ├─ editar.php
│  │  └─ excluir.php
│  ├─ conexao.php
│  ├─ database copy.sql
│  └─ enviar_cifra.php
├─ assets/
│  ├─ css/
│  │  ├─ cadastro.css
│  │  ├─ esqueci_senha.css
│  │  ├─ index.css
│  │  └─ planos.css
│  ├─ img/
│  │  ├─ perfil/
│  │  │  ├─ 6a558cbf0bf5b.png
│  │  │  ├─ 6a5649611b1eb.png
│  │  │  ├─ 6a564fa0076fe.png
│  │  │  ├─ 6a564fbf72f85.png
│  │  │  ├─ 6a583bf29ce97.png
│  │  │  ├─ 6a583c0bac8a0.png
│  │  │  ├─ 6a583ecc62462.png
│  │  │  ├─ 6a583f0edbcfe.png
│  │  │  ├─ 6a583f7dd2f7b.png
│  │  │  ├─ 6a58407a2acc2.png
│  │  │  ├─ 6a584ad1cb1d7.png
│  │  │  ├─ 6a598b91016f9.png
│  │  │  ├─ 6a598bc55e07a.png
│  │  │  ├─ 6a598ddce7cfa.png
│  │  │  ├─ 6a5995232c494.png
│  │  │  ├─ 6a5a3b8589f2c.png
│  │  │  ├─ 6a5a3fdd3f0b2.png
│  │  │  ├─ 6a5a42e00db46.png
│  │  │  ├─ 6a5ae07a7bfea.png
│  │  │  ├─ 6a5b7457e0d0f.png
│  │  │  ├─ 6a5b77b0842d9.png
│  │  │  ├─ 6a5b77fba476d.png
│  │  │  ├─ 6a5b7823825e1.png
│  │  │  ├─ 6a5b7daae63c9.png
│  │  │  ├─ 6a5b7e4150d5b.png
│  │  │  ├─ 6a5b7ec9ac176.png
│  │  │  ├─ 6a5b7f4018587.png
│  │  │  ├─ 6a5b80c86d7a1.png
│  │  │  ├─ 6a5b80fa6c7f5.png
│  │  │  └─ 6a5b96f512d57.png
│  │  ├─ logo_amarela.png
│  │  ├─ logo_azul.png
│  │  ├─ logo.png
│  │  └─ logo2.png
│  ├─ js/
│  │  ├─ cadastro.js
│  │  └─ functions.js
│  └─ mp4/
│     ├─ cadastrar.mp4
│     └─ violao.mp4
├─ assinante/
│  ├─ assets/
│  │  ├─ img/
│  │  │  └─ perfil/
│  │  │     ├─ 6a50e4f1aff55.png
│  │  │     ├─ 6a50e99b14f7e.png
│  │  │     ├─ 6a524b7a4eb43.png
│  │  │     ├─ 6a524bdb5d2e0.png
│  │  │     ├─ c4f3c3a2-8751-4378-85c2-3f555fd77ec8.jpeg
│  │  │     └─ WhatsApp Image 2026-07-09 at 12.25.24.jpeg
│  │  └─ js/
│  │     └─ functions_assinante.js
│  └─ includes/
│     ├─ footer_assinante.php
│     ├─ header_assinante.php
│     ├─ menu_assinante.php
│     └─ verifica_assinante.php
├─ admin.php
├─ aluno.php
├─ assinante.php
├─ cadastrar_usuario.php
├─ esqueci_senha.php
├─ index.php
├─ planos.php
├─ recuperar_senha.php
└─ reset_senha.php
