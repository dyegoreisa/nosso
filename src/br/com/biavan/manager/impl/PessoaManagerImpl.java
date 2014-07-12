package br.com.biavan.manager.impl;

import java.util.ArrayList;
import java.util.List;

import javax.persistence.NonUniqueResultException;

import org.hibernate.HibernateException;

import br.com.biavan.dao.PessoaDAO;
import br.com.biavan.dao.impl.PessoaDAOImpl;
import br.com.biavan.manager.PessoaManager;
import br.com.biavan.model.Pessoa;
import br.com.biavan.util.HibernateUtil;

public class PessoaManagerImpl implements PessoaManager {

	private PessoaDAO pessoaDAO = new PessoaDAOImpl();
	
	@Override
	public Pessoa buscarPessoaPorNome(String nome, String sobrenome) {
		Pessoa pessoa = null;
		try {
			HibernateUtil.beginTransaction();
			pessoa = pessoaDAO.buscarPorNome(nome, sobrenome);
			HibernateUtil.commitTransaction();
		} catch (NonUniqueResultException ex) {
			System.out.println("Handle your error here");
			System.out.println("Query returned more than one results.");
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
		}
		return pessoa;
	}

	@Override
	public List<Pessoa> carregarTodosPessoas() {
		List<Pessoa> allPersons = new ArrayList<Pessoa>();
		try {
			HibernateUtil.beginTransaction();
			allPersons = pessoaDAO.listar(Pessoa.class);
			HibernateUtil.commitTransaction();
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
		}
		return allPersons;
	}

	@Override
	public void salvarNovoPessoa(Pessoa pessoa) {
		try {
			HibernateUtil.beginTransaction();
			pessoaDAO.salvar(pessoa);
			HibernateUtil.commitTransaction();
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
			HibernateUtil.rollbackTransaction();
		}

	}

	@Override
	public Pessoa buscarPessoaPorId(long id) {
		Pessoa pessoa = null;
		try {
			HibernateUtil.beginTransaction();
			pessoa = (Pessoa) pessoaDAO.buscarPorId(Pessoa.class, id);
			HibernateUtil.commitTransaction();
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
		}
		return pessoa;
	}

	@Override
	public void removerPessoa(Pessoa pessoa) {
		try {
            HibernateUtil.beginTransaction();
            pessoaDAO.remover(pessoa);
            HibernateUtil.commitTransaction();
        } catch (HibernateException ex) {
            System.out.println("Handle your error here");
            HibernateUtil.rollbackTransaction();
        }

	}

}
