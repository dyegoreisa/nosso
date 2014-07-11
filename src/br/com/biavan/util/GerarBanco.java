package br.com.biavan.util;

import org.hibernate.cfg.Configuration;
import org.hibernate.tool.hbm2ddl.SchemaExport;

public class GerarBanco {
	
	public static void main(String[] args) {
		System.out.println("Inicio");

		Configuration cfg = new Configuration();
		cfg.configure();
		SchemaExport se = new SchemaExport(cfg);
		se.create(true, true);

		System.out.println("Fim");
	}


}
