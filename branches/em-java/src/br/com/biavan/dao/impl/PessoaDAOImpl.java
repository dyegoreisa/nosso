package br.com.biavan.dao.impl;

import org.hibernate.Query;

import br.com.biavan.dao.PessoaDAO;
import br.com.biavan.dao.generic.GenericDAOImpl;
import br.com.biavan.model.Pessoa;
import br.com.biavan.util.HibernateUtil;

public class PessoaDAOImpl extends GenericDAOImpl<Pessoa, Long> implements
		PessoaDAO {

	@Override
	public Pessoa buscarPorNome(String nome, String sobrenome) {
		String sql = "SELECT p FROM Pessoa p WHERE p.nome = :nome OR p.sobrenome";
		Query query = HibernateUtil.getSession().createQuery(sql)
				.setParameter("nome", nome)
				.setParameter("sobrenome", sobrenome);
		return buscarUm(query);
	}

}
