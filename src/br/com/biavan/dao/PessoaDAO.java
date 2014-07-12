package br.com.biavan.dao;

import br.com.biavan.dao.generic.GenericDAO;
import br.com.biavan.model.Pessoa;

public interface PessoaDAO  extends GenericDAO<Pessoa, Long> {
	
	public Pessoa buscarPorNome(String nome, String sobrenome);
}
