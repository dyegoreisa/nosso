package br.com.biavan.manager;

import java.util.List;

import br.com.biavan.model.Usuario;

public interface UsuarioManager {
	
	public Usuario buscarUsuarioPorLogin(String login);
	 
    public List<Usuario> carregarTodosUsuarios();
 
    public void salvarNovoUsuario(Usuario usuario);
 
    public Usuario buscarUsuarioPorId(long id);
 
    public void removerUsuario(Usuario usuario);
}
