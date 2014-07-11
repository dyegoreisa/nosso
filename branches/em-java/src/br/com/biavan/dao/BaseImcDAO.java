package br.com.biavan.dao;

import java.util.List;

import br.com.biavan.model.BaseImc;

public interface BaseImcDAO {
	public boolean salvar(BaseImc baseImc);
	public boolean atualizar(BaseImc baseImc);
	public boolean remover(BaseImc baseImc);
	public List<BaseImc> listar();
	public List<BaseImc> buscar(List<String> params);
	public BaseImc buscarPorId(long id);
}
