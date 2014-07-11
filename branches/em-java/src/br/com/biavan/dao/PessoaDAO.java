package br.com.biavan.dao;

import java.util.List;

import br.com.biavan.model.Pessoa;

public interface PessoaDAO {
	public boolean salvar(Pessoa pessoa);
	public boolean atualizar(Pessoa pessoa);
	public boolean remover(Pessoa pessoa);
	public List<Pessoa> listar();
	public List<Pessoa> buscar(List<String> params);
	public Pessoa buscarPorId(long id);
}
