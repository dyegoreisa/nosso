package br.com.biavan.dao;

import java.util.List;

import br.com.biavan.model.Meta;

public interface MetaDAO {
	public boolean salvar(Meta meta);
	public boolean atualizar(Meta meta);
	public boolean remover(Meta meta);
	public List<Meta> listar();
	public List<Meta> buscar(List<String> params);
	public Meta buscarPorId(long id);
}
