package br.com.biavan.model;

import java.io.Serializable;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;
import javax.persistence.UniqueConstraint;

@Entity
@Table(name="perfil_usuario",
	uniqueConstraints = {@UniqueConstraint(columnNames={"codigo", "login"})}
)
public class PerfilUsuario implements Serializable {

	private static final long serialVersionUID = 411013419783726149L;

	@Id
	private String login;
	
	@Id
	private String codigo;

	public String getLogin() {
		return login;
	}

	public void setLogin(String login) {
		this.login = login;
	}

	public String getCodigo() {
		return codigo;
	}
	
	public void setCodigo(String codigo) {
		this.codigo = codigo;
	}
}
