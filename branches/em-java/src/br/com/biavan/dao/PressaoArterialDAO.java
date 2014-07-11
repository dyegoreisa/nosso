package br.com.biavan.dao;

import java.util.List;

import br.com.biavan.model.PressaoArterial;

public interface PressaoArterialDAO {
	public boolean salvar(PressaoArterial pressaoArterial);
	public boolean atualizar(PressaoArterial pressaoArterial);
	public boolean remover(PressaoArterial pressaoArterial);
	public List<PressaoArterial> listar();
	public List<PressaoArterial> buscar(List<String> params);
	public PressaoArterial buscarPorId(long id);
}
