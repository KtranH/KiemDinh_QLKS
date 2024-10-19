use QLKS

// DICHVU Collection
db.createCollection("dichvu", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["madv", "tendv", "giadv"],
         properties: {
            madv: { bsonType: "string" },
            tendv: { bsonType: "string" },
            giadv: { bsonType: "number" }
         }
      }
   }
})

// CT_HOADON Collection
db.createCollection("ct_hoadon", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["mahd", "madv", "soluong"],
         properties: {
            mahd: { bsonType: "string" },
            madv: { bsonType: "string" },
            soluong: { bsonType: "int" }
         }
      }
   }
})

// HOADON Collection
db.createCollection("hoadon", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["mahd", "mapdp", "manv", "ngaylap", "thanhtoan"],
         properties: {
            mahd: { bsonType: "string" },
            mapdp: { bsonType: "string" },
            manv: { bsonType: "string" },
            ngaylap: { bsonType: "date" },
            thanhtoan: { bsonType: "number" }
         }
      }
   }
})

// NHANVIEN Collection
db.createCollection("nhanvien", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["manv", "tennv", "ngaysinh", "tentk", "ngvl", "sdt", "email", "diachi", "cmnd"],
         properties: {
            manv: { bsonType: "string" },
            tennv: { bsonType: "string" },
            ngaysinh: { bsonType: "date" },
            tentk: { bsonType: "string" },
            ngvl: { bsonType: "date" },
            sdt: { bsonType: "string" },
            email: { bsonType: "string" },
            diachi: { bsonType: "string" },
            cmnd: { bsonType: "string" }
         }
      }
   }
})

// NHOMQUYEN Collection
db.createCollection("nhomquyen", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["manhomquyen", "maq"],
         properties: {
            manhomquyen: { bsonType: "string" },
            maq: { bsonType: "string" }
         }
      }
   }
})

// PHANQUYEN Collection
db.createCollection("phanquyen", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["maq", "chucnang"],
         properties: {
            maq: { bsonType: "string" },
            chucnang: { bsonType: "string" }
         }
      }
   }
})

// PHIEUDATPHONG Collection
db.createCollection("phieudatphong", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["mapdp", "manv", "maph", "ngaylap", "ngaydat", "ngaytra"],
         properties: {
            mapdp: { bsonType: "string" },
            manv: { bsonType: "string" },
            maph: { bsonType: "string" },
            ngaylap: { bsonType: "date" },
            ngaydat: { bsonType: "date" },
            ngaytra: { bsonType: "date" }, // New field for checkout date
            tinhtrang: { bsonType: "string" }
         }
      }
   }
})

// CT_PHIEUDATPHONG Collection
db.createCollection("ct_phieudatphong", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["mapdp", "maph"],
         properties: {
            mapdp: { bsonType: "string" },
            maph: { bsonType: "string" }
         }
      }
   }
})

// PHONG Collection
db.createCollection("phong", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["maph", "tenphong", "vitri", "giathue", "tinhtrang", "maloai"],
         properties: {
            maph: { bsonType: "string" },
            tenphong: { bsonType: "string" },
            vitri: { bsonType: "string" },
            giathue: { bsonType: "number" },
            tinhtrang: { bsonType: "string" },
            maloai: { bsonType: "string" }
         }
      }
   }
})

// LOAIPHONG Collection
db.createCollection("loaiphong", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["maloai", "tenloai", "sischua"],
         properties: {
            maloai: { bsonType: "string" },
            tenloai: { bsonType: "string" },
            sischua: { bsonType: "int" }
         }
      }
   }
})

// KHACH Collection
db.createCollection("khach", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["makh", "tenkh", "cccd", "sdt"],
         properties: {
            makh: { bsonType: "string" },
            tenkh: { bsonType: "string" },
            cccd: { bsonType: "string" },
            sdt: { bsonType: "string" }
         }
      }
   }
})