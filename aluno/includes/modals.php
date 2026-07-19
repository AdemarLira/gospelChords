<!-- Modal Enviar Cifra -->
<div class="modal fade" id="modalEnviarCifra" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    🎵 Enviar Nova Cifra
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <form
                action="../api/enviar_cifra.php"
                method="POST"
                enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Nome da música</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nome_musica"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Autor</label>
                        <input
                            type="text"
                            class="form-control"
                            name="autor"
                            required>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Versão</label>
                            <input
                                type="text"
                                class="form-control"
                                name="versao"
                                placeholder="Original, Simplificada...">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Categoria</label>

                            <select
                                name="id_categoria"
                                class="form-select"
                                required>

                                <option value="">Selecione</option>
                                <option value="1">🎵 Cifra</option>
                                <option value="2">🎸 Tablatura</option>
                                <option value="3">🎼 Partitura</option>

                            </select>
                        </div>

                    </div>

                  <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">
                            Tom
                        </label>

                        <select name="tom" class="form-select">
                            <option value="">Selecione o tom</option>
                            <option>C</option>
                            <option>C#</option>
                            <option>D</option>
                            <option>Eb</option>
                            <option>E</option>
                            <option>F</option>
                            <option>F#</option>
                            <option>G</option>
                            <option>Ab</option>
                            <option>A</option>
                            <option>Bb</option>
                            <option>B</option>
                            <option>Cm</option>
                            <option>C#m</option>
                            <option>Dm</option>
                            <option>Ebm</option>
                            <option>Em</option>
                            <option>Fm</option>
                            <option>F#m</option>
                            <option>Gm</option>
                            <option>G#m</option>
                            <option>Am</option>
                            <option>Bbm</option>
                            <option>Bm</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Capotraste
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="capotraste"
                            placeholder="Ex.: Casa 2">
                    </div>

                </div>

                    <div class="mb-3">
                        <label>Link do YouTube</label>

                        <input
                            type="url"
                            class="form-control"
                            name="youtube"
                            placeholder="https://www.youtube.com/watch?v=...">
                    </div>

                    <div class="mb-3">

                        <label>Arquivo (.doc ou .docx)</label>

                        <input
                            type="file"
                            class="form-control"
                            name="arquivo"
                            accept=".doc,.docx"
                            required>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success">
                        📤 Enviar Cifra
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>