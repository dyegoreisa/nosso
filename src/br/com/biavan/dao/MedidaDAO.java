package br.com.biavan.dao;

import java.util.List;

import br.com.biavan.model.Medida;

public interface MedidaDAO {
	public boolean salvar(Medida medida);
	public boolean atualizar(Medida medida);
	public boolean remover(Medida medida);
	public List<Medida> listar();
	public List<Medida> buscar(List<String> params);
	public Medida buscarPorId(long id);
}
