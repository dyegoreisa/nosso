package br.com.biavan.model;

import java.io.Serializable;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;

import br.com.biavan.util.Sexo;
import br.com.biavan.util.TipoOsseo;

@Entity
@Table(name = "base_imc")
public class BaseImc implements Serializable {

	private static final long serialVersionUID = -8551518250332832919L;

	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private long id;
	
	private Sexo sexo;
	
	private TipoOsseo tipoOsseo;
	
	private double imc;

	public long getId() {
		return id;
	}

	public void setId(long id) {
		this.id = id;
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

	public double getImc() {
		return imc;
	}

	public void setImc(double imc) {
		this.imc = imc;
	}
	
	
}
