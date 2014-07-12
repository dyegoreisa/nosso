package br.com.biavan.manager;

import java.util.List;

import br.com.biavan.model.Pessoa;

public interface PessoaManager {

	public Pessoa buscarPessoaPorNome(String nome, String sobrenome);
	 
    public List<Pessoa> carregarTodosPessoas();
 
    public void salvarNovoPessoa(Pessoa pessoa);
 
    public Pessoa buscarPessoaPorId(long id);
 
    public void removerPessoa(Pessoa pessoa);
}
