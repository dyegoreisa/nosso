package br.com.biavan.model;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;

import br.com.biavan.util.Sexo;
import br.com.biavan.util.TipoOsseo;

@Entity
@Table(name = "pessoa")
public class Pessoa {

	@Id
	@GeneratedValue
	private long id;
	
	private String nome;
	
	private String sobrenome;
	
	private Sexo sexo;
	
	private TipoOsseo tipoOsseo;

	public long getId() {
		return id;
	}

	public void setId(long id) {
		this.id = id;
	}

	public String getNome() {
		return nome;
	}

	public void setNome(String nome) {
		this.nome = nome;
	}

	public String getSobrenome() {
		return sobrenome;
	}

	public void setSobrenome(String sobrenome) {
		this.sobrenome = sobrenome;
	}

	public Sexo getSexo() {
		return sexo;
	}

	public void setSexo(Sexo sexo) {
		this.sexo = sexo;
	}

	public TipoOsseo getTipoOsseo() {
		return tipoOsseo;
	}

	public void setTipoOsseo(TipoOsseo tipoOsseo) {
		this.tipoOsseo = tipoOsseo;
	}
	
	
}
