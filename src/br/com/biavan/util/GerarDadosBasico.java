package br.com.biavan.util;

import br.com.biavan.manager.PerfilManager;
import br.com.biavan.manager.PerfilUsuarioManager;
import br.com.biavan.manager.PessoaManager;
import br.com.biavan.manager.UsuarioManager;
import br.com.biavan.manager.impl.PerfilManagerImpl;
import br.com.biavan.manager.impl.PerfilUsuarioManagerImpl;
import br.com.biavan.manager.impl.PessoaManagerImpl;
import br.com.biavan.manager.impl.UsuarioManagerImpl;
import br.com.biavan.model.Perfil;
import br.com.biavan.model.PerfilUsuario;
import br.com.biavan.model.Pessoa;
import br.com.biavan.model.Usuario;

public class GerarDadosBasico {

	public static void main(String[] args) {
		
		Pessoa pessoa1 = new Pessoa();
		pessoa1.setNome("Administrador");
		pessoa1.setSobrenome("Administrador");
		pessoa1.setSexo(Sexo.MASCULINO);
		pessoa1.setTipoOsseo(TipoOsseo.FINO);
		
		PessoaManager mngPessoa1 = new PessoaManagerImpl();
		mngPessoa1.salvarNovaPessoa(pessoa1);
		
		Usuario usuario1 = new Usuario();
		usuario1.setLogin("admin");
		usuario1.setSenha("teste");
		usuario1.setPessoa(pessoa1);
		
		UsuarioManager mngUsuario1 = new UsuarioManagerImpl();
		mngUsuario1.salvarNovoUsuario(usuario1);
		
		Perfil perfil1 = new Perfil();
		perfil1.setCodigo("ADM");
		perfil1.setNome("Administrador");
		
		PerfilManager mngPerfil1 = new PerfilManagerImpl();
		mngPerfil1.salvarNovoPerfil(perfil1);
		
		PerfilUsuario prfUsu1 = new PerfilUsuario();
		prfUsu1.setCodigo("ADM");
		prfUsu1.setLogin("admin");
		
		PerfilUsuarioManager mngPerfilUsuario1 = new PerfilUsuarioManagerImpl();
		mngPerfilUsuario1.salvarNovoPerfilUsuario(prfUsu1);
		

		
		Pessoa pessoa2 = new Pessoa();
		pessoa2.setNome("Dyego");
		pessoa2.setSobrenome("Azevedo");
		pessoa2.setSexo(Sexo.MASCULINO);
		pessoa2.setTipoOsseo(TipoOsseo.LARGO);

		PessoaManager mngPessoa2 = new PessoaManagerImpl();
		mngPessoa2.salvarNovaPessoa(pessoa2);
		
		Usuario usuario2 = new Usuario();
		usuario2.setLogin("dyego");
		usuario2.setSenha("teste");
		usuario2.setPessoa(pessoa2);

		UsuarioManager mngUsuario2 = new UsuarioManagerImpl();
		mngUsuario2.salvarNovoUsuario(usuario2);

		Perfil perfil2 = new Perfil();
		perfil2.setCodigo("USR");
		perfil2.setNome("Usuario");

		PerfilManager mngPerfil2 = new PerfilManagerImpl();
		mngPerfil2.salvarNovoPerfil(perfil2);

		PerfilUsuario prfUsu2 = new PerfilUsuario();
		prfUsu2.setCodigo("USR");
		prfUsu2.setLogin("dyego");
		
		PerfilUsuarioManager mngPerfilUsuario2 = new PerfilUsuarioManagerImpl();
		mngPerfilUsuario2.salvarNovoPerfilUsuario(prfUsu2);

	}

}
