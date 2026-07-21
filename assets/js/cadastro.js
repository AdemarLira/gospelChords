// ===============================
// MÁSCARA DO CELULAR
// ===============================

const campoCelular = document.getElementById("celular");

campoCelular.addEventListener("input", function () {

    let valor = this.value.replace(/\D/g, "");

    // Limita a 11 números
    valor = valor.substring(0, 11);

    if (valor.length > 10) {
        // Celular: (99) 99999-9999
        valor = valor.replace(
            /^(\d{2})(\d{5})(\d{0,4})/,
            "($1) $2-$3"
        );
    } else {
        // Telefone: (99) 9999-9999
        valor = valor.replace(
            /^(\d{2})(\d{4})(\d{0,4})/,
            "($1) $2-$3"
        );
    }

    this.value = valor;
});


// ===============================
// ESTADOS E CIDADES (IBGE)
// ===============================

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

    // Carrega as cidades
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

                campoCidade.style.display = "block";
            })
            .catch(error => {
                console.error(error);
            });
    });

});