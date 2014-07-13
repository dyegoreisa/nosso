package br.com.biavan.manager;

import java.util.List;

import br.com.biavan.model.Perfil;

public interface PerfilManager {

	public Perfil buscarPerfilPorCodigo(String codigo);
	 
    public List<Perfil> carregarTodosPerfils();
 
    public void salvarNovoPerfil(Perfil perfil);
 
    public Perfil buscarPerfilPorId(long id);
 
    public void removerPerfil(Perfil perfil);
}
